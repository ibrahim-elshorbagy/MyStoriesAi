<?php

namespace App\Http\Controllers\Admin\Story;

use App\Http\Controllers\Controller;
use App\Models\Admin\Story\Category\AgeCategory;
use App\Models\Admin\Story\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
  public function index(Request $request)
  {
    $request->validate([
      'title' => ['nullable', 'string', 'max:255'],
      'status' => ['nullable', 'in:draft,published,archived'],
      'category_id' => ['nullable', 'exists:age_categories,id'],
      'gender' => ['nullable', 'in:0,1'],
      'sort' => ['nullable', 'string', 'in:updated_at,status,title_value'],
      'direction' => ['nullable', 'string', 'in:asc,desc'],
      'per_page' => ['nullable', 'integer', 'min:1'],
    ]);

    $sortField = $request->input('sort', 'updated_at');
    $sortDirection = $request->input('direction', 'desc');
    $perPage = $request->input('per_page', 15);

    $query = Story::with('category');

    // Filter by title
    if ($request->filled('title')) {
      $query->where(function ($q) use ($request) {
        $q->where('title->ar', 'like', '%' . $request->title . '%')
          ->orWhere('title->en', 'like', '%' . $request->title . '%');
      });
    }

    // Filter by status
    if ($request->filled('status')) {
      $query->where('status', $request->status);
    }

    // Filter by category
    if ($request->filled('category_id')) {
      $query->where('category_id', $request->category_id);
    }

    // Filter by gender
    if ($request->filled('gender')) {
      $query->where('gender', $request->gender);
    }

    $stories = $query->orderBy($sortField, $sortDirection)
      ->paginate($perPage)
      ->withQueryString();

    // Add row numbers
    $stories = $this->addRowNumbers($stories);

    $categories = AgeCategory::all();

    return inertia('Admin/Story/Stories/Stories', [
      'stories' => $stories,
      'categories' => $categories,
      'queryParams' => $request->query() ?: null,
    ]);
  }

  public function create()
  {
    $categories = AgeCategory::all();

    return inertia('Admin/Story/Stories/Partials/Pages/CreateStory', [
      'categories' => $categories,
    ]);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'title_ar' => ['required', 'string', 'max:255'],
      'title_en' => ['required', 'string', 'max:255'],
      'content_ar' => ['required', 'string'],
      'content_en' => ['required', 'string'],
      'category_id' => ['required', 'exists:age_categories,id'],
      'gender' => ['nullable', 'in:0,1'],
      'status' => ['required', 'in:draft,published,archived'],
    ]);

    Story::create([
      'title' => [
        'ar' => $validated['title_ar'],
        'en' => $validated['title_en'],
      ],
      'content' => [
        'ar' => $validated['content_ar'],
        'en' => $validated['content_en'],
      ],
      'category_id' => $validated['category_id'],
      'gender' => $validated['gender'],
      'status' => $validated['status'],
    ]);

    return redirect()->route('admin.stories.index')
      ->with('title', __('website_response.story_created_title'))
      ->with('message', __('website_response.story_created_message'))
      ->with('status', 'success');
  }

  public function edit(Story $story)
  {
    $categories = AgeCategory::all();

    return inertia('Admin/Story/Stories/Partials/Pages/EditStory', [
      'story' => $story->load('category'),
      'categories' => $categories,
    ]);
  }

  public function update(Request $request, Story $story)
  {
    $validated = $request->validate([
      'title_ar' => ['required', 'string', 'max:255'],
      'title_en' => ['required', 'string', 'max:255'],
      'content_ar' => ['required', 'string'],
      'content_en' => ['required', 'string'],
      'category_id' => ['required', 'exists:age_categories,id'],
      'gender' => ['nullable', 'in:0,1'],
      'status' => ['required', 'in:draft,published,archived'],
    ]);

    $story->update([
      'title' => [
        'ar' => $validated['title_ar'],
        'en' => $validated['title_en'],
      ],
      'content' => [
        'ar' => $validated['content_ar'],
        'en' => $validated['content_en'],
      ],
      'category_id' => $validated['category_id'],
      'gender' => $validated['gender'],
      'status' => $validated['status'],
    ]);

    return back()
      ->with('title', __('website_response.story_updated_title'))
      ->with('message', __('website_response.story_updated_message'))
      ->with('status', 'success');
  }

  public function destroy(Story $story)
  {
    $story->delete();

    return back()
      ->with('title', __('website_response.story_deleted_title'))
      ->with('message', __('website_response.story_deleted_message'))
      ->with('status', 'success');
  }

  // Bulk actions
  public function bulkPublish(Request $request)
  {
    $validated = $request->validate([
      'ids' => ['required', 'array'],
      'ids.*' => ['exists:stories,id'],
    ]);

    Story::whereIn('id', $validated['ids'])->update(['status' => 'published']);

    return back()
      ->with('title', __('website_response.stories_published_title'))
      ->with('message', __('website_response.stories_published_message', ['count' => count($validated['ids'])]))
      ->with('status', 'success');
  }

  public function bulkArchive(Request $request)
  {
    $validated = $request->validate([
      'ids' => ['required', 'array'],
      'ids.*' => ['exists:stories,id'],
    ]);

    Story::whereIn('id', $validated['ids'])->update(['status' => 'archived']);

    return back()
      ->with('title', __('website_response.stories_archived_title'))
      ->with('message', __('website_response.stories_archived_message', ['count' => count($validated['ids'])]))
      ->with('status', 'success');
  }

  public function bulkDelete(Request $request)
  {
    $validated = $request->validate([
      'ids' => ['required', 'array'],
      'ids.*' => ['exists:stories,id'],
    ]);

    Story::whereIn('id', $validated['ids'])->delete();

    return back()
      ->with('title', __('website_response.stories_deleted_title'))
      ->with('message', __('website_response.stories_deleted_message', ['count' => count($validated['ids'])]))
      ->with('status', 'success');
  }


}
