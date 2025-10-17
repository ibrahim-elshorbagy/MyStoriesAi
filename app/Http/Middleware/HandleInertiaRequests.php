<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
  /**
   * The root template that is loaded on the first page visit.
   *
   * @var string
   */
  protected $rootView = 'app';

  /**
   * Determine the current asset version.
   */
  public function version(Request $request): ?string
  {
    return parent::version($request);
  }

  /**
   * Define the props that are shared by default.
   *
   * @return array<string, mixed>
   */
  public function share(Request $request): array
  {
    return [
      ...parent::share($request),
      'auth' => [
        'user' => $request->user(),
        'roles' => $request->user()?->getRoleNames(),
        'permissions' => $request->user()?->getAllPermissions()->pluck('name'),
      ],
      'flash' => [
        'title' => session('title'),
        'message' => session('message'),
        'status' => session('status'), //success / error / warning
        'type' => session('type'),
        'webhookResponse' => session('webhookResponse'),
      ],
      'impersonate_admin_id' => session('impersonate_admin_id'),

      // 'translations' => fn () => __('website'),
      'available_locales' => ['en', 'ar'],
      'locale' => fn () => app()->getLocale(),
      'csrf_token' => csrf_token(),
      'cookie_data' => $this->getCookieData(),
      'footer' => $this->getFooterData(),
    ];
  }

  /**
   * Get cookie data
   */
  private function getCookieData(): array
  {
    return \App\Models\Admin\SiteSetting\SiteSetting::whereIn('key', [
      'cookie_message_ar',
      'cookie_message_en',
    ])
      ->pluck('value', 'key')
      ->toArray();
  }

  /**
   * Get footer data with caching
   */
  private function getFooterData(): array
  {
    // return Cache::remember('footer_data', 3600, function () { // Cache for 1 hour
      $settings = \App\Models\Admin\SiteSetting\SiteSetting::whereIn('key', [
        'support_email',
        'support_mobile',
        'support_whatsapp',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'linkedin_link',
        'youtube_link',
        'tiktok_link',
        'snapchat_link',
        'pinterest_link',
      ])->whereNotNull('value')
        ->where('value', '!=', '')
        ->pluck('value', 'key')
        ->toArray();

      $staticPages = []; // No longer needed as pages are included in categories

      $categories = \App\Models\Admin\SiteSetting\StaticPageCategory::with(['staticPages' => function ($query) {
        $query->where('status', 'published')->orderBy('created_at', 'desc');
      }])
        ->whereHas('staticPages', function ($query) {
          $query->where('status', 'published');
        })
        ->get(['id', 'name'])
        ->map(function ($category) {
          return [
            'id' => $category->id,
            'name' => $category->name_value,
            'pages' => $category->staticPages->map(function ($page) {
              return [
                'id' => $page->id,
                'title' => $page->title_value,
                'url' => route('static-page', $page->id),
              ];
            }),
          ];
        });

      return [
        'settings' => $settings,
        'static_pages' => $staticPages,
        'categories' => $categories,
      ];
    // });
  }
}
