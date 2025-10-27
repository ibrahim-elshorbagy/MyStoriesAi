<?php

namespace App\Http\Controllers\Frontend\Order;

use App\Http\Controllers\Controller;
use App\Models\Admin\SiteSetting\DeliveryOption;
use App\Models\Admin\SiteSetting\SiteSetting;
use App\Models\Admin\Story\Story;
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
use App\Services\PaymobService;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class OrderController extends Controller
{
  protected $paymobService;

  public function __construct(PaymobService $paymobService)
  {
    $this->paymobService = $paymobService;
  }

  // Show the multi-step form`
  public function create(Request $request)
  {
    $storyId = $request->query('story_id');
    $story = null;

    if ($storyId) {
      $story = Story::with('category')->findOrFail($storyId);
      // Format story data for frontend
      $story = [
        'id' => $story->id,
        'title_value' => $story->title_value,
        'cover_image_ar' => $story->cover_image_ar,
        'cover_image_en' => $story->cover_image_en,
      ];
    }

    $settings = SiteSetting::whereIn('key', ['first_plan_price', 'second_plan_price', 'third_plan_price'])
      ->pluck('value', 'key')
      ->map(function ($value) {
        return is_numeric($value) ? (float) $value : 0;
      })
      ->toArray();

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
      'story' => $story,
    ]);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'story_id' => ['nullable', 'exists:stories,id'],
      'face_swap_result' => ['nullable', 'string'],
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
      'delivery_option_id' => ['nullable', 'required_if:format,second_plan,third_plan', 'exists:delivery_options,id'],
      'area' => ['required_unless:format,first_plan', 'nullable', 'string', 'max:255'],
      'street' => ['required_unless:format,first_plan', 'nullable', 'string', 'max:255'],
      'house_number' => ['required_unless:format,first_plan', 'nullable', 'string', 'max:255'],
      'additional_info' => ['nullable', 'string', 'max:500'],
    ]);

    DB::beginTransaction();

    try {
      $userId = Auth::id();

      // Get pricing from SiteSetting
      $settings = SiteSetting::whereIn('key', ['first_plan_price', 'second_plan_price', 'third_plan_price'])
        ->pluck('value', 'key')
        ->map(function ($value) {
          return is_numeric($value) ? (float) $value : 0;
        })
        ->toArray();

      // Calculate story price based on format
      $storyPrice = 0;
      switch ($validated['format']) {
        case 'first_plan':
          $storyPrice = $settings['first_plan_price'] ?? 0;
          break;
        case 'second_plan':
          $storyPrice = $settings['second_plan_price'] ?? 0;
          break;
        case 'third_plan':
          $storyPrice = $settings['third_plan_price'] ?? 0;
          break;
      }

      // Calculate delivery price
      $deliveryPrice = 0;
      if ($validated['format'] !== 'first_plan' && isset($validated['delivery_option_id'])) {
        $deliveryOption = DeliveryOption::find($validated['delivery_option_id']);

        if ($deliveryOption) {
          $deliveryPrice = $deliveryOption->price ?? 0;
        }
      }

      // Calculate total price
      $totalPrice = $storyPrice + $deliveryPrice;

      $order = Order::create([
        'user_id' => $userId,
        'story_id' => $validated['story_id'] ?? null,
        'child_name' => $validated['child_name'],
        'child_age' => $validated['child_age'],
        'language' => $validated['language'],
        'child_gender' => $validated['child_gender'],
        'format' => $validated['format'],
        'value' => json_encode($validated['value']),
        'custom_value' => $validated['custom_value'] ?? null,
        'status' => 'pending',
        'payment_method' => 'cod',

        'story_price' => $storyPrice,
        'delivery_price' => $deliveryPrice,
        'total_price' => $totalPrice,

        'customer_note' => $validated['customer_note'] ?? null,
        'hair_color' => $validated['hair_color'] ?? null,
        'hair_style' => $validated['hair_style'] ?? null,
        'eye_color' => $validated['eye_color'] ?? null,
        'skin_tone' => $validated['skin_tone'] ?? null,
        'clothing_description' => $validated['clothing_description'] ?? null,
      ]);

      // Upload child image
      if ($request->hasFile('child_image')) {
        $path = "users/{$userId}/{$order->id}/images";
        $imagePath = $request->file('child_image')->store($path, 'public');
        $order->update(['child_image_path' => $imagePath]);
      }

      // Handle face swap result if exists
      if (!empty($validated['face_swap_result'])) {
        // Save the face swap result
        // The face_swap_result might be a base64 or URL
        // You'll need to download and save it
        $faceSwapPath = $this->saveFaceSwapImage($validated['face_swap_result'], $userId, $order->id);
        $order->update(['face_swap_image_path' => $faceSwapPath]);
      }


      // Create shipping address if needed
      if ($validated['format'] !== 'first_plan' && !empty($validated['delivery_option_id'])) {
        $order->shippingAddress()->create([
          'delivery_option_id' => $validated['delivery_option_id'],
          'area' => $validated['area'],
          'street' => $validated['street'],
          'house_number' => $validated['house_number'],
          'additional_info' => $validated['additional_info'] ?? null,
        ]);
      }

      // Send notifications
      try {
        if ($order->user) {
          $order->user->notify(new OrderConfirmation($order));
        }

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

  private function saveFaceSwapImage($imageData, $userId, $orderId)
  {
    // Handle base64 or URL
    if (filter_var($imageData, FILTER_VALIDATE_URL)) {
      // It's a URL, download it
      $contents = file_get_contents($imageData);
    } else {
      // It's base64
      $contents = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
    }

    $path = "users/{$userId}/{$orderId}/face_swap";
    $filename = 'face_swap_' . time() . '.png';
    Storage::disk('public')->put("{$path}/{$filename}", $contents);

    return "{$path}/{$filename}";
  }



  // Payment Method Selection
  public function payment(Order $order)
  {
    if ($order->user_id !== Auth::id()) {
      abort(403);
    }
    // if ($order->payments()->exists()) {
    //   return redirect()->route('user.orders.show', $order->id)
    //     ->with('title', __('website_response.payment_already_initiated_title'))
    //     ->with('message', __('website_response.payment_already_initiated'))
    //     ->with('status', 'error');
    // }


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

      // Create payment record
      $payment = Payment::create([
        'order_id' => $order->id,
        'payment_method' => $validated['payment_method'],
        'status' => 'pending',
        'amount' => $order->total_price,
      ]);

      // Update order payment method
      $order->update(['payment_method' => $validated['payment_method']]);

      DB::commit();

      if ($validated['payment_method'] === 'cod') {
        $payment->update(['status' => 'pending']);
        $order->update(['status' => 'pending']);

        return redirect()->route('home')
          ->with('title', __('website_response.order_created_cod_title'))
          ->with('message', __('website_response.order_created_cod_message'))
          ->with('status', 'success');
      } else {
        // Handle Paymob payment
        $result = $this->paymobService->sendPayment($order);

        Log::info('Paymob payment result: ' . json_encode($result));  
        if (!$result['status']) {
          return redirect()->route('home')
            ->with('title', __('website_response.payment_error_title'))
            ->with('message', $result['message'])
            ->with('status', 'error');
        }

        // Update payment with transaction id
        $payment->update(['transaction_id' => $result['paymob_order_id']]);

        return redirect($result['url']);
      }
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->route('home')
        ->with('title', __('website_response.payment_error_title'))
        ->with('message', __('website_response.payment_failed'))
        ->with('status', 'error');
    }
  }
}
