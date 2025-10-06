<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\SiteSetting\Faq;
use App\Models\Admin\SiteSetting\FaqCategory;

class HomeController extends Controller
{
  public function home()
  {
    $faqs = Faq::where('show_in_home', true)->orderBy('updated_at', 'desc')->get();

    return inertia("Frontend/Home/Home", [
      'faqs' => $faqs,
    ]);
  }

  public function FaqPage()
  {
    $categories = FaqCategory::with(['faqs' => function($query) {
      $query->orderBy('updated_at', 'desc');
    }])->orderBy('updated_at', 'desc')->get();

    return inertia("Frontend/FAQ/FAQs", [
      'categories' => $categories,
    ]);
  }
}
