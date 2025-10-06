<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\SiteSetting\Faq;

class HomeController extends Controller
{
  public function home()
  {
    $faqs = Faq::orderBy('updated_at', 'desc')->get();

    return inertia("Frontend/Home/Home", [
      'faqs' => $faqs,
    ]);
  }
}
