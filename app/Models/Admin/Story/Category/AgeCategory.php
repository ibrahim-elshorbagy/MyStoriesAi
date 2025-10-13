<?php

namespace App\Models\Admin\Story\Category;

use Illuminate\Database\Eloquent\Model;

class AgeCategory extends Model
{
    protected $guarded = ['id'];

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
}
