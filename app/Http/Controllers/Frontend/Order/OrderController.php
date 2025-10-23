<?php

namespace App\Http\Controllers\Frontend\Order;

use App\Http\Controllers\Controller;
use App\Models\Admin\SiteSetting\DeliveryOption;
use App\Models\Admin\SiteSetting\SiteSetting;
use App\Models\Order\Order;
use App\Models\Order\Payment;
use App\Models\User;
use App\Notifications\Orders\Creating\NotifyAdmin;
use App\Notifications\Orders\Creating\OrderConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class OrderController extends Controller
{
  // Show the multi-step form
  public function create()
  {
    // Get pricing settings
        $settings = SiteSetting::whereIn('key', ['first_plan_price', 'second_plan_price', 'third_plan_price'])
      ->pluck('value', 'key')
      ->map(function ($value) {
        return is_numeric($value) ? (float) $value : 0;
      })
      ->toArray();

    // Get delivery options
    $deliveryOptions = DeliveryOption::all()->map(function ($option) {
      return [
        'id' => $option->id,
        'city_value' => $option->city_value,
        'price' => $option->price,
      ];
    });

    return Inertia::render('Frontend/Order/CreateOrder', [
      'pricing' => $settings,
      'deliveryOptions' => $deliveryOptions,
    ]);
  }

  // Store the complete order
  public function store(Request $request)
  {
    $validated = $request->validate([
      'child_name' => ['required', 'string', 'max:255'],
      'child_age' => ['required', 'integer', 'min:1'],
      'language' => ['required', 'in:arabic,english'],
      'child_gender' => ['required', 'in:boy,girl'],
      'format' => ['required', 'in:first_plan,second_plan,third_plan'],
      'value' => ['required', 'array', 'min:1'],
      'value.*' => ['string', 'in:honesty,kindness,courage,respect,responsibility,friendship,perseverance,creativity'],
      'custom_value' => ['nullable', 'string', 'max:500'],
      'child_image' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
      'hair_color' => ['nullable', 'string', 'max:255'],
      'hair_style' => ['nullable', 'string', 'max:255'],
      'eye_color' => ['nullable', 'string', 'max:255'],
      'skin_tone' => ['nullable', 'string', 'max:255'],
      'clothing_description' => ['nullable', 'string', 'max:1000'],
      'customer_note' => ['nullable', 'string', 'max:1000'],
      'story_price' => ['required', 'numeric', 'min:0'],
      'delivery_price' => ['required', 'numeric', 'min:0'],
      'total_price' => ['required', 'numeric', 'min:0'],
      'delivery_option_id' => ['required_unless:format,pdf', 'nullable', 'exists:delivery_options,id'],
      'area' => ['required_unless:format,pdf', 'nullable', 'string', 'max:255'],
      'street' => ['required_unless:format,pdf', 'nullable', 'string', 'max:255'],
      'house_number' => ['required_unless:format,pdf', 'nullable', 'string', 'max:255'],
      'additional_info' => ['nullable', 'string', 'max:500'],
    ]);

    DB::beginTransaction();

    try {
      $userId = Auth::id();

      // Step 1: Create the order first (without image)
      $order = Order::create([
        'user_id' => $userId,
        'child_name' => $validated['child_name'],
        'child_age' => $validated['child_age'],
        'language' => $validated['language'],
        'child_gender' => $validated['child_gender'],
        'format' => $validated['format'],
        'value' => json_encode($validated['value']),
        'custom_value' => $validated['custom_value'] ?? null,
        'status' => 'pending',
        'payment_method' => 'cod',
        'story_price' => $validated['story_price'],
        'delivery_price' => $validated['delivery_price'],
        'total_price' => $validated['total_price'],
        'customer_note' => $validated['customer_note'] ?? null,
        'hair_color' => $validated['hair_color'] ?? null,
        'hair_style' => $validated['hair_style'] ?? null,
        'eye_color' => $validated['eye_color'] ?? null,
        'skin_tone' => $validated['skin_tone'] ?? null,
        'clothing_description' => $validated['clothing_description'] ?? null,
      ]);

      $imagePath = null;
      if ($request->hasFile('child_image')) {
        $path = "users/{$userId}/{$order->id}/images";
        $imagePath = $request->file('child_image')->store($path, 'public');
        $order->update(['child_image_path' => $imagePath]);
      }

      // Step 3: Create shipping address if needed
      if ($validated['format'] !== 'pdf' && !empty($validated['delivery_option_id'])) {
        $order->shippingAddress()->create([
          'delivery_option_id' => $validated['delivery_option_id'],
          'area' => $validated['area'],
          'street' => $validated['street'],
          'house_number' => $validated['house_number'],
          'additional_info' => $validated['additional_info'] ?? null,
        ]);
      }

      // Step 4: Send notifications
      try {
        $order->user->notify(new OrderConfirmation($order));

        $adminEmailSetting = SiteSetting::where('key', 'admin_notification_email')->first();
        if ($adminEmailSetting && $adminEmailSetting->value) {
          $adminUser = new User();
          $adminUser->email = $adminEmailSetting->value;
          $adminUser->name = 'Admin';
          $adminUser->notify(new NotifyAdmin($order));
        }
      } catch (\Exception $e) {
        Log::error('Failed to send order notification emails: ' . $e->getMessage());
      }

      DB::commit();

      return redirect()->route('frontend.order.payment', $order->id)
        ->with('title', __('website_response.order_created_title'))
        ->with('message', __('website_response.order_created_message'))
        ->with('status', 'success');

    } catch (\Exception $e) {
      DB::rollBack();
      return back()->withErrors([
        'submit' => 'Failed to create order: ' . $e->getMessage()
      ])->withInput();
    }
  }


  // Payment Method Selection
  public function payment(Order $order)
  {
    if ($order->user_id !== Auth::id()) {
      abort(403);
    }

    return Inertia::render('Frontend/Order/PaymentMethod', [
      'order' => $order->load('shippingAddress'),
    ]);
  }

  // Process Payment
  public function processPayment(Request $request, Order $order)
  {
    if ($order->user_id !== Auth::id()) {
      abort(403);
    }

    $validated = $request->validate([
      'payment_method' => ['required', 'in:paymob,cod'],
    ]);

    DB::beginTransaction();

    try {
      $order->update([
        'payment_method' => $validated['payment_method'],
        'status' => $validated['payment_method'] === 'cod' ? 'processing' : 'pending',
      ]);

      // Create payment record
      Payment::create([
        'order_id' => $order->id,
        'payment_method' => $validated['payment_method'],
        'status' => $validated['payment_method'] === 'cod' ? 'paid' : 'pending',
        'amount' => $order->total_price,
      ]);

      DB::commit();

      if ($validated['payment_method'] === 'cod') {
        return redirect()->route('home')
          ->with('title', __('website_response.order_created_title'))
          ->with('message', __('website_response.order_created_message'))
          ->with('status', 'success');
      } else {
        // Redirect to Paymob payment gateway
        return redirect()->route('frontend.payment.paymob', $order->id);
      }
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->withErrors(['error' => 'Payment processing failed. Please try again.']);
    }
  }
}
