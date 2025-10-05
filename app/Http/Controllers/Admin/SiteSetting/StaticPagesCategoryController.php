<?php

namespace App\Http\Controllers\Admin\SiteSetting;

use App\Http\Controllers\Controller;
use App\Models\Admin\SiteSetting\StaticPageCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StaticPagesCategoryController extends Controller
{
  public function index(Request $request)
  {
    $request->validate([
      'name' => ['nullable', 'string', 'max:255'],
      'sort' => ['nullable', 'string', 'in:id,name,created_at,updated_at'],
      'direction' => ['nullable', 'string', 'in:asc,desc'],
      'per_page' => ['nullable', 'integer', 'min:1'],
    ]);

    $sortField = $request->input('sort', 'updated_at');
    $sortDirection = $request->input('direction', 'desc');
    $perPage = $request->input('per_page', 15);

    $query = StaticPageCategory::query();

    // Filter by name
    if ($request->filled('name')) {
      $query->where('name', 'like', '%' . $request->name . '%');
    }

    $categories = $query->orderBy($sortField, $sortDirection)
      ->paginate($perPage)
      ->withQueryString();

    // Add row numbers
    $categories = $this->addRowNumbers($categories);

    return inertia('Admin/SiteSetting/StaticPagesCategories/StaticPagesCategories', [
      'categories' => $categories,
      'queryParams' => $request->query() ?: null,
    ]);
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'name' => ['required', 'string', 'max:255', 'unique:static_page_categories,name'],
    ]);

    StaticPageCategory::create($data);

    return back()
      ->with('title', __('website_response.static_page_category_created_title'))
      ->with('message', __('website_response.static_page_category_created_message'))
      ->with('status', 'success');
  }

  public function update(Request $request, StaticPageCategory $staticPageCategory)
  {
    $data = $request->validate([
      'name' => ['required', 'string', 'max:255', 'unique:static_page_categories,name,' . $staticPageCategory->id],
    ]);

    $staticPageCategory->update($data);

    return back()
      ->with('title', __('website_response.static_page_category_updated_title'))
      ->with('message', __('website_response.static_page_category_updated_message'))
      ->with('status', 'success');
  }

  public function destroy(Request $request, StaticPageCategory $staticPageCategory)
  {
    // Check if category has associated pages
    if ($staticPageCategory->staticPages()->count() > 0) {
      return back()
        ->with('title', __('website_response.static_page_category_delete_failed_title'))
        ->with('message', __('website_response.static_page_category_delete_failed_message'))
        ->with('status', 'error');
    }

    $staticPageCategory->delete();

    return back()
      ->with('title', __('website_response.static_page_category_deleted_title'))
      ->with('message', __('website_response.static_page_category_deleted_message'))
      ->with('status', 'success');
  }

  public function bulkDelete(Request $request)
  {
    $validated = $request->validate([
      'ids' => ['required', 'array'],
      'ids.*' => ['exists:static_page_categories,id'],
    ]);

    // Check if any categories have associated pages
    $categoriesWithPages = StaticPageCategory::whereIn('id', $validated['ids'])
      ->whereHas('staticPages')
      ->count();

    if ($categoriesWithPages > 0) {
      return back()
        ->with('title', __('website_response.static_page_categories_bulk_delete_failed_title'))
        ->with('message', __('website_response.static_page_categories_bulk_delete_failed_message'))
        ->with('status', 'error');
    }

    StaticPageCategory::whereIn('id', $validated['ids'])->delete();

    return back()
      ->with('title', __('website_response.static_page_categories_deleted_title'))
      ->with('message', __('website_response.static_page_categories_deleted_message', ['count' => count($validated['ids'])]))
      ->with('status', 'success');
  }
}
