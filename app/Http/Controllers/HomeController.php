<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\SiteSetting\Faq;
use App\Models\Admin\SiteSetting\FaqCategory;
use App\Models\Admin\Story\Story;
use App\Models\Admin\Story\Category\AgeCategory;
use App\Models\Admin\SiteSetting\SiteSetting;
use App\Models\Admin\SiteSetting\CustomerFeedback;

class HomeController extends Controller
{
  public function home()
  {
    $faqs = Faq::where('show_in_home', true)->orderBy('updated_at', 'desc')->get();
    $stories = Story::with('category')
      ->where('status', 'published')
      ->latest()
      ->take(4)
      ->get();
    $categories = AgeCategory::all();
    $settings = SiteSetting::all()->pluck('value', 'key')->toArray();
    $textFeedbacks = CustomerFeedback::whereNotNull('customer_feedback')->whereNull('image')->get();
    $imageFeedbacks = CustomerFeedback::whereNull('customer_feedback')->whereNotNull('image')->get();

    return inertia("Frontend/Home/Home", [
      'faqs' => $faqs,
      'stories' => $stories,
      'categories' => $categories,
      'settings' => $settings,
      'textFeedbacks' => $textFeedbacks,
      'imageFeedbacks' => $imageFeedbacks,
    ]);
  }

  public function FaqPage()
  {
    $categories = FaqCategory::with([
      'faqs' => function ($query) {
        $query->orderBy('updated_at', 'desc');
      }
    ])->orderBy('updated_at', 'desc')->get();

    return inertia("Frontend/FAQ/FAQs", [
      'categories' => $categories,
    ]);
  }
}
