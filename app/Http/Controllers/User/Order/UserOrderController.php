<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
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

    $query = Order::with(['user', 'payments', 'shippingAddress', 'story'])
      ->where('user_id', Auth::id()); // Only show user's own orders

    // Filter by child name
    if ($request->filled('name')) {
      $query->where('child_name', 'like', '%' . $request->name . '%');
    }

    $orders = $query->orderBy($sortField, $sortDirection)
      ->paginate($perPage)
      ->withQueryString();

    // Add row numbers
    $orders = $this->addRowNumbers($orders);

    return inertia('User/Order/Orders', [
      'orders' => $orders,
      'queryParams' => $request->query() ?: null,
    ]);
  }

  public function show(Order $order)
  {
    // Ensure user can only view their own orders
    if ($order->user_id !== Auth::id()) {
      abort(403, 'Unauthorized');
    }

    $order->load(['user', 'payments', 'shippingAddress.deliveryOption', 'story']);

    return inertia('User/Order/Partials/Pages/ViewOrder', [
      'order' => $order,
    ]);
  }
}
