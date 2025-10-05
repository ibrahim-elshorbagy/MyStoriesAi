<?php

namespace App\Models\Admin\SiteSetting;

use Illuminate\Database\Eloquent\Model;

class StaticPageCategory extends Model
{
    protected $fillable = ['name'];

    protected $casts = [
        'name' => 'array',
    ];

    protected function getTranslatedValue(array $translations): string
    {
        $locale = app()->getLocale();
        return $translations[$locale] ?? $translations['en'] ?? '';
    }

    protected $appends = ['name_value'];

    public function getNameValueAttribute(): string
    {
        return $this->getTranslatedValue($this->name ?? []);
    }

    public function staticPages()
    {
        return $this->hasMany(StaticPage::class, 'category_id');
    }
}
