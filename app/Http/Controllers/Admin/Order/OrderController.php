<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order\Order;

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

    return inertia('Admin/Order/Partials/Pages/ViewOrder', [
      'order' => $order,
    ]);
  }


}
