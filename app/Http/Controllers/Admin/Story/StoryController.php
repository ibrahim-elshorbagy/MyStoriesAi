<?php

namespace App\Http\Controllers\Admin\Story;

use App\Http\Controllers\Controller;
use App\Models\Admin\Story\Category\AgeCategory;
use App\Models\Admin\Story\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
      'excerpt_ar' => ['required', 'string',"max:350"],
      'excerpt_en' => ['required', 'string',"max:350"],
      'content_ar' => ['required', 'string'],
      'content_en' => ['required', 'string'],
      'category_id' => ['required', 'exists:age_categories,id'],
      'gender' => ['nullable', 'in:0,1'],
      'status' => ['required', 'in:draft,published,archived'],

      // Cover images
      'cover_image_ar' => ['nullable', 'image'],
      'cover_image_en' => ['nullable', 'image'],

      // Gallery images
      'gallery_images_ar' => ['nullable', 'array', 'max:10'],
      'gallery_images_ar.*' => ['image'],
      'gallery_images_en' => ['nullable', 'array', 'max:10'],
      'gallery_images_en.*' => ['image'],

      // PDFs
      'pdf_ar' => ['nullable', 'file', 'mimes:pdf'],
      'pdf_en' => ['nullable', 'file', 'mimes:pdf'],
    ]);

    $story = Story::create([
      'title' => [
        'ar' => $validated['title_ar'],
        'en' => $validated['title_en'],
      ],
      'excerpt' => [
        'ar' => $validated['excerpt_ar'],
        'en' => $validated['excerpt_en'],
      ],
      'content' => [
        'ar' => $validated['content_ar'],
        'en' => $validated['content_en'],
      ],
      'category_id' => $validated['category_id'],
      'gender' => $validated['gender'],
      'status' => $validated['status'],
    ]);

    // Handle file uploads
    $this->handleFileUploads($request, $story);

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
      'excerpt_ar' => ['required', 'string',"max:350"],
      'excerpt_en' => ['required', 'string',"max:350"],
      'content_ar' => ['required', 'string'],
      'content_en' => ['required', 'string'],
      'category_id' => ['required', 'exists:age_categories,id'],
      'gender' => ['nullable', 'in:0,1'],
      'status' => ['required', 'in:draft,published,archived'],

      // Cover images
      'cover_image_ar' => ['nullable', 'image'],
      'cover_image_en' => ['nullable', 'image'],

      // Gallery images - new uploads
      'gallery_images_ar' => ['nullable', 'array', 'max:10'],
      'gallery_images_ar.*' => ['image'],
      'gallery_images_en' => ['nullable', 'array', 'max:10'],
      'gallery_images_en.*' => ['image'],

      // Existing gallery images to keep
      'existing_gallery_images_ar' => ['nullable', 'array'],
      'existing_gallery_images_ar.*' => ['string'],
      'existing_gallery_images_en' => ['nullable', 'array'],
      'existing_gallery_images_en.*' => ['string'],

      // PDFs
      'pdf_ar' => ['nullable', 'file', 'mimes:pdf'],
      'pdf_en' => ['nullable', 'file', 'mimes:pdf'],
    ]);

    $story->update([
      'title' => [
        'ar' => $validated['title_ar'],
        'en' => $validated['title_en'],
      ],
      'excerpt' => [
        'ar' => $validated['excerpt_ar'],
        'en' => $validated['excerpt_en'],
      ],
      'content' => [
        'ar' => $validated['content_ar'],
        'en' => $validated['content_en'],
      ],
      'category_id' => $validated['category_id'],
      'gender' => $validated['gender'],
      'status' => $validated['status'],
    ]);

    // Handle file uploads and deletions
    $this->handleFileUploads($request, $story);

    return redirect()->route('admin.stories.index')
      ->with('title', __('website_response.story_updated_title'))
      ->with('message', __('website_response.story_updated_message'))
      ->with('status', 'success');
  }

  public function destroy(Story $story)
  {
    // Delete all associated files
    $this->deleteStoryFiles($story);

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

    $stories = Story::whereIn('id', $validated['ids'])->get();

    // Delete files for each story
    foreach ($stories as $story) {
      $this->deleteStoryFiles($story);
    }

    Story::whereIn('id', $validated['ids'])->delete();

    return back()
      ->with('title', __('website_response.stories_deleted_title'))
      ->with('message', __('website_response.stories_deleted_message', ['count' => count($validated['ids'])]))
      ->with('status', 'success');
  }

  /**
   * Handle file uploads for a story
   */
  private function handleFileUploads(Request $request, Story $story)
  {
    $storyId = $story->id;

    // Handle cover images
    if ($request->hasFile('cover_image_ar')) {
      // Delete old cover image if exists
      if ($story->cover_image_ar) {
        Storage::disk('public')->delete($story->cover_image_ar);
      }

      $coverImageAr = $request->file('cover_image_ar')->store(
        "admin/story/{$storyId}/ar/cover",
        'public'
      );
      $story->update(['cover_image_ar' => $coverImageAr]);
    }

    if ($request->hasFile('cover_image_en')) {
      // Delete old cover image if exists
      if ($story->cover_image_en) {
        Storage::disk('public')->delete($story->cover_image_en);
      }

      $coverImageEn = $request->file('cover_image_en')->store(
        "admin/story/{$storyId}/en/cover",
        'public'
      );
      $story->update(['cover_image_en' => $coverImageEn]);
    }

    // Handle gallery images for Arabic
    $this->handleGalleryImages($request, $story, 'ar');

    // Handle gallery images for English
    $this->handleGalleryImages($request, $story, 'en');

    // Handle PDFs
    if ($request->hasFile('pdf_ar')) {
      // Delete old PDF if exists
      if ($story->pdf_ar) {
        Storage::disk('public')->delete($story->pdf_ar);
      }

      $pdfAr = $request->file('pdf_ar')->store(
        "admin/story/{$storyId}/ar/pdf",
        'public'
      );
      $story->update(['pdf_ar' => $pdfAr]);
    }

    if ($request->hasFile('pdf_en')) {
      // Delete old PDF if exists
      if ($story->pdf_en) {
        Storage::disk('public')->delete($story->pdf_en);
      }

      $pdfEn = $request->file('pdf_en')->store(
        "admin/story/{$storyId}/en/pdf",
        'public'
      );
      $story->update(['pdf_en' => $pdfEn]);
    }
  }

  /**
   * Handle gallery images for a specific language
   */
  private function handleGalleryImages(Request $request, Story $story, string $locale)
  {
    $storyId = $story->id;
    $galleryField = "gallery_images_{$locale}";
    $existingField = "existing_gallery_images_{$locale}";

    // Get existing images from database
    $existingImagesInDb = $story->{$galleryField} ?? [];

    // Get images that frontend wants to keep
    $imagesToKeep = $request->input($existingField, []);

    // Find images to delete (in DB but not in keep list)
    $imagesToDelete = array_diff($existingImagesInDb, $imagesToKeep);

    // Delete removed images from storage
    foreach ($imagesToDelete as $imagePath) {
      if ($imagePath && Storage::disk('public')->exists($imagePath)) {
        Storage::disk('public')->delete($imagePath);
      }
    }

    // Start with images to keep
    $finalGallery = $imagesToKeep;

    // Add new uploaded images
    if ($request->hasFile($galleryField)) {
      $newImages = [];
      foreach ($request->file($galleryField) as $file) {
        $path = $file->store("admin/story/{$storyId}/{$locale}/gallery", 'public');
        $newImages[] = $path;
      }
      $finalGallery = array_merge($finalGallery, $newImages);
    }

    // Update story with final gallery
    $story->update([$galleryField => array_values($finalGallery)]);
  }

  /**
   * Delete all files associated with a story
   */
  private function deleteStoryFiles(Story $story)
  {
    // Delete cover images
    if ($story->cover_image_ar) {
      Storage::disk('public')->delete($story->cover_image_ar);
    }
    if ($story->cover_image_en) {
      Storage::disk('public')->delete($story->cover_image_en);
    }

    // Delete gallery images
    if ($story->gallery_images_ar) {
      foreach ($story->gallery_images_ar as $imagePath) {
        Storage::disk('public')->delete($imagePath);
      }
    }
    if ($story->gallery_images_en) {
      foreach ($story->gallery_images_en as $imagePath) {
        Storage::disk('public')->delete($imagePath);
      }
    }

    // Delete PDFs
    if ($story->pdf_ar) {
      Storage::disk('public')->delete($story->pdf_ar);
    }
    if ($story->pdf_en) {
      Storage::disk('public')->delete($story->pdf_en);
    }

    // Delete the entire story directory
    Storage::disk('public')->deleteDirectory("admin/story/{$story->id}");
  }

  protected function addRowNumbers($paginatedItems)
  {
    $currentPage = $paginatedItems->currentPage();
    $perPage = $paginatedItems->perPage();
    $startNumber = ($currentPage - 1) * $perPage + 1;

    foreach ($paginatedItems as $index => $item) {
      $item->row_number = $startNumber + $index;
    }

    return $paginatedItems;
  }
}
