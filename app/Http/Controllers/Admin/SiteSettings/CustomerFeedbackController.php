<?php

namespace App\Http\Controllers\Admin\SiteSettings;

use App\Http\Controllers\Controller;
use App\Models\Admin\SiteSetting\CustomerFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CustomerFeedbackController extends Controller
{
  public function index(Request $request)
  {
    $request->validate([
      'sort' => ['nullable', 'string', 'in:id,created_at,updated_at'],
      'direction' => ['nullable', 'string', 'in:asc,desc'],
      'per_page' => ['nullable', 'integer', 'min:1'],
    ]);

    $sortField = $request->input('sort', 'updated_at');
    $sortDirection = $request->input('direction', 'desc');
    $perPage = $request->input('per_page', 15);

    $query = CustomerFeedback::query();

    $feedbacks = $query->orderBy($sortField, $sortDirection)
      ->paginate($perPage)
      ->withQueryString();

    // Add row numbers
    $feedbacks = $this->addRowNumbers($feedbacks);

    return Inertia::render('Admin/SiteSetting/CustomerFeedbacks/CustomerFeedbacks', [
      'feedbacks' => $feedbacks,
      'queryParams' => $request->query() ?: null,
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'customer_feedback' => ['nullable', 'string'],
      'image' => ['nullable', 'image'],
    ]);

    // At least one must be provided
    if (!$request->filled('customer_feedback') && !$request->hasFile('image')) {
      return back()->withErrors(['general' => __('website.at_least_one_required')]);
    }

    $imagePath = null;
    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('customer_feedbacks', 'public');
    }

    CustomerFeedback::create([
      'customer_feedback' => $request->customer_feedback,
      'image' => $imagePath,
    ]);

    return back()
      ->with('title', __('website_response.customer_feedback_created_title'))
      ->with('message', __('website_response.customer_feedback_created_message'))
      ->with('status', 'success');
  }

  public function update(Request $request, CustomerFeedback $customerFeedback)
  {
    $request->validate([
      'customer_feedback' => ['nullable', 'string'],
      'image' => ['nullable', 'image'],
      'remove_image' => ['boolean'],
    ]);

    // At least one must be provided: either text or image (existing or new)
    $hasText = $request->filled('customer_feedback');
    $hasNewImage = $request->hasFile('image');
    $hasExistingImage = $customerFeedback->image && !$request->boolean('remove_image');

    if (!$hasText && !$hasNewImage && !$hasExistingImage) {
      return back()->withErrors(['general' => __('website.at_least_one_required')]);
    }

    $imagePath = $customerFeedback->image;
    if ($request->boolean('remove_image')) {
      // Delete old image if exists
      if ($customerFeedback->image) {
        Storage::disk('public')->delete($customerFeedback->image);
      }
      $imagePath = null;
    } elseif ($request->hasFile('image')) {
      // Delete old image
      if ($customerFeedback->image) {
        Storage::disk('public')->delete($customerFeedback->image);
      }
      $imagePath = $request->file('image')->store('customer_feedbacks', 'public');
    }

    $customerFeedback->update([
      'customer_feedback' => $request->customer_feedback,
      'image' => $imagePath,
    ]);

    return back()
      ->with('title', __('website_response.customer_feedback_updated_title'))
      ->with('message', __('website_response.customer_feedback_updated_message'))
      ->with('status', 'success');
  }

  public function destroy(Request $request, CustomerFeedback $customerFeedback)
  {
    // Delete image if exists
    if ($customerFeedback->image) {
      Storage::disk('public')->delete($customerFeedback->image);
    }

    $customerFeedback->delete();

    return back()
      ->with('title', __('website_response.customer_feedback_deleted_title'))
      ->with('message', __('website_response.customer_feedback_deleted_message'))
      ->with('status', 'success');
  }

  public function bulkDelete(Request $request)
  {
    $validated = $request->validate([
      'ids' => ['required', 'array'],
      'ids.*' => ['exists:customer_feedback,id'],
    ]);

    $feedbacks = CustomerFeedback::whereIn('id', $validated['ids'])->get();

    // Delete images
    foreach ($feedbacks as $feedback) {
      if ($feedback->image) {
        Storage::disk('public')->delete($feedback->image);
      }
    }

    CustomerFeedback::whereIn('id', $validated['ids'])->delete();

    return back()
      ->with('title', __('website_response.customer_feedbacks_bulk_deleted_title'))
      ->with('message', __('website_response.customer_feedbacks_bulk_deleted_message'))
      ->with('status', 'success');
  }
}
