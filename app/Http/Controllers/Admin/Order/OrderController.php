<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\Order;
use App\Models\Order\Payment;
use Illuminate\Support\Facades\Storage;
use App\Notifications\Orders\Status\PaymentStatusUpdate;
use App\Notifications\Orders\Status\OrderStatusUpdate;
use App\Notifications\Orders\Status\PDFUploaded;

class OrderController extends Controller
{
  public function index(Request $request)
  {
    $request->validate([
      'name' => ['nullable', 'string', 'max:255'],
      'sort' => ['nullable', 'string', 'in:id,child_name,created_at,updated_at,status'],
      'direction' => ['nullable', 'string', 'in:asc,desc'],
      'per_page' => ['nullable', 'integer', 'min:1'],
    ]);

    $sortField = $request->input('sort', 'updated_at');
    $sortDirection = $request->input('direction', 'desc');
    $perPage = $request->input('per_page', 15);

    $query = Order::with(['user', 'payments', 'shippingAddress']);

    // Filter by child name or user name
    if ($request->filled('name')) {
      $query->where(function ($q) use ($request) {
        $q->where('child_name', 'like', '%' . $request->name . '%')
          ->orWhereHas('user', function ($userQuery) use ($request) {
            $userQuery->where('name', 'like', '%' . $request->name . '%');
          });
      });
    }

    $orders = $query->orderBy($sortField, $sortDirection)
      ->paginate($perPage)
      ->withQueryString();

    // Add row numbers
    $orders = $this->addRowNumbers($orders);

    return inertia('Admin/Order/Orders', [
      'orders' => $orders,
      'queryParams' => $request->query() ?: null,
    ]);
  }

  public function show(Order $order)
  {
    $order->load(['user', 'payments', 'shippingAddress.deliveryOption']);

    // Check if PDF file exists, if not, set pdf_path to null
    if ($order->pdf_path && !Storage::disk('public')->exists($order->pdf_path)) {
      $order->pdf_path = null;
    }

    return inertia('Admin/Order/Partials/Pages/ViewOrder', [
      'order' => $order,
    ]);
  }

  public function updatePaymentStatus(Request $request, Order $order)
  {
    $request->validate([
      'status' => 'required|in:pending,paid,failed,refunded',
    ]);

    $payment = $order->payments()->first();
    if (!$payment) {
      return back()
        ->with('title', __('website_response.no_payment_found_title'))
        ->with('message', __('website_response.no_payment_found'))
        ->with('status', 'error');
    }

    $payment->update(['status' => $request->status]);

    return back()
      ->with('title', __('website_response.payment_status_updated_title'))
      ->with('message', __('website_response.payment_status_updated'))
      ->with('status', 'success');
  }

  public function notifyPaymentStatus(Request $request, Order $order)
  {
    $request->validate([
      'locale' => 'nullable|in:ar,en',
    ]);

    $payment = $order->payments()->first();
    if (!$payment) {
      return back()
        ->with('title', __('website_response.no_payment_found_title'))
        ->with('message', __('website_response.no_payment_found'))
        ->with('status', 'error');
    }

    $order->user->notify(new PaymentStatusUpdate($order, $payment, $request->locale));

    return back()
      ->with('title', __('website_response.notification_sent_title'))
      ->with('message', __('website_response.notification_sent'))
      ->with('status', 'success');
  }

  public function updateStatus(Request $request, Order $order)
  {
    $request->validate([
      'status' => 'required|in:pending,processing,completed,cancelled',
    ]);

    $order->update(['status' => $request->status]);

    return back()
      ->with('title', __('website_response.order_status_updated_title'))
      ->with('message', __('website_response.order_status_updated'))
      ->with('status', 'success');
  }

  public function notifyStatus(Request $request, Order $order)
  {
    $request->validate([
      'locale' => 'nullable|in:ar,en',
    ]);

    $order->user->notify(new OrderStatusUpdate($order, $request->locale));

    return back()
      ->with('title', __('website_response.notification_sent_title'))
      ->with('message', __('website_response.notification_sent'))
      ->with('status', 'success');
  }

  public function uploadPDF(Request $request, Order $order)
  {
    $request->validate([
      'pdf_file' => 'required|file|mimes:pdf|max:51200', // 50MB max
    ]);


    // Delete old PDF if exists
    if ($order->pdf_path) {
      Storage::disk('public')->delete($order->pdf_path);
    }

    $file = $request->file('pdf_file');

    // Create secure, unique filename
    $userId = $order->user_id;
    $timestamp = now()->timestamp;
    $filename = "story_{$order->child_name}_{$timestamp}.pdf";

    $path = $file->storeAs("users/{$userId}/{$order->id}/pdf", $filename, 'public');

    // Save to DB
    $order->update(['pdf_path' => $path]);

    return back()
      ->with('title', __('website_response.pdf_uploaded_title'))
      ->with('message', __('website_response.pdf_uploaded_message'))
      ->with('status', 'success');
  }


  public function notifyPDF(Request $request, Order $order)
  {
    $request->validate([
      'locale' => 'nullable|in:ar,en',
    ]);

    if (!$order->pdf_path) {
      return back()
        ->with('title', __('website_response.pdf_not_found_title'))
        ->with('message', __('website_response.pdf_not_found'))
        ->with('status', 'error');
    }

    $order->user->notify(new PDFUploaded($order, $request->locale));

    return back()
      ->with('title', __('website_response.notification_sent_title'))
      ->with('message', __('website_response.notification_sent'))
      ->with('status', 'success');
  }

  protected function addRowNumbers($paginatedOrders)
  {
    $currentPage = $paginatedOrders->currentPage();
    $perPage = $paginatedOrders->perPage();
    $startNumber = ($currentPage - 1) * $perPage + 1;

    $paginatedOrders->getCollection()->transform(function ($order, $index) use ($startNumber) {
      $order->row_number = $startNumber + $index;
      return $order;
    });

    return $paginatedOrders;
  }
}
