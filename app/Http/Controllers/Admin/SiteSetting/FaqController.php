<?php

namespace App\Http\Controllers\Admin\SiteSetting;

use App\Http\Controllers\Controller;
use App\Models\Admin\SiteSetting\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
  public function index(Request $request)
  {
    $request->validate([
      'question' => ['nullable', 'string', 'max:255'],
      'sort' => ['nullable', 'string', 'in:id,updated_at'],
      'direction' => ['nullable', 'string', 'in:asc,desc'],
      'per_page' => ['nullable', 'integer', 'min:1'],
    ]);

    $sortField = $request->input('sort', 'updated_at');
    $sortDirection = $request->input('direction', 'desc');
    $perPage = $request->input('per_page', 15);

    $query = Faq::query();

    // Filter by question
    if ($request->filled('question')) {
      $locale = app()->getLocale();
      $query->where("question->{$locale}", 'like', '%' . $request->question . '%')
        ->orWhere("question->en", 'like', '%' . $request->question . '%');
    }

    $faqs = $query->orderBy($sortField, $sortDirection)
      ->paginate($perPage)
      ->withQueryString();

    // Add row numbers
    $faqs = $this->addRowNumbers($faqs);

    return inertia('Admin/SiteSetting/FAQ/Faq', [
      'faqs' => $faqs,
      'queryParams' => $request->query() ?: null,
    ]);
  }

  public function create()
  {
    return inertia('Admin/SiteSetting/FAQ/Partials/Pages/CreateFAQ');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'question_ar' => ['required', 'string', 'max:255'],
      'question_en' => ['required', 'string', 'max:255'],
      'answer_ar' => ['required', 'string'],
      'answer_en' => ['required', 'string'],
    ]);

    Faq::create([
      'question' => [
        'ar' => $validated['question_ar'],
        'en' => $validated['question_en'],
      ],
      'answer' => [
        'ar' => $validated['answer_ar'],
        'en' => $validated['answer_en'],
      ],
    ]);

    return redirect()->route('admin.faq.index')
      ->with('title', __('website_response.faq_created_title'))
      ->with('message', __('website_response.faq_created_message'))
      ->with('status', 'success');
  }

  public function edit(Faq $faq)
  {
    return inertia('Admin/SiteSetting/FAQ/Partials/Pages/EditFAQ', [
      'faq' => $faq,
    ]);
  }

  public function update(Request $request, Faq $faq)
  {
    $validated = $request->validate([
      'question_ar' => ['required', 'string', 'max:255'],
      'question_en' => ['required', 'string', 'max:255'],
      'answer_ar' => ['required', 'string'],
      'answer_en' => ['required', 'string'],
    ]);

    $faq->update([
      'question' => [
        'ar' => $validated['question_ar'],
        'en' => $validated['question_en'],
      ],
      'answer' => [
        'ar' => $validated['answer_ar'],
        'en' => $validated['answer_en'],
      ],
    ]);

    return back()
      ->with('title', __('website_response.faq_updated_title'))
      ->with('message', __('website_response.faq_updated_message'))
      ->with('status', 'success');
  }

  public function destroy(Request $request, Faq $faq)
  {
    $faq->delete();

    return back()
      ->with('title', __('website_response.faq_deleted_title'))
      ->with('message', __('website_response.faq_deleted_message'))
      ->with('status', 'warning');
  }

  public function bulkDelete(Request $request)
  {
    $validated = $request->validate([
      'ids' => ['required', 'array'],
      'ids.*' => ['required', 'integer', 'exists:faqs,id'],
    ]);

    Faq::whereIn('id', $validated['ids'])->delete();

    return back()
      ->with('title', __('website_response.faqs_deleted_title'))
      ->with('message', __('website_response.faqs_deleted_message', ['count' => count($validated['ids'])]))
      ->with('status', 'warning');
  }
}
