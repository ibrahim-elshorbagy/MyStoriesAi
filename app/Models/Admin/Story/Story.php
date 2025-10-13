<?php

namespace App\Models\Admin\Story;

use App\Models\Admin\Story\Category\AgeCategory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
    ];

    protected function getTranslatedValue(array $translations): string
    {
        $locale = app()->getLocale();
        return $translations[$locale] ?? $translations['en'] ?? '';
    }

    protected $appends = ['title_value', 'content_value'];

    public function getTitleValueAttribute(): string
    {
        return $this->getTranslatedValue($this->title ?? []);
    }

    public function getContentValueAttribute(): string
    {
        return $this->getTranslatedValue($this->content ?? []);
    }

    public function category()
    {
        return $this->belongsTo(AgeCategory::class, 'category_id');
    }

    public function getGenderTextAttribute(): string
    {
        if ($this->gender === null) {
            return '';
        }
        return $this->gender === 0 ? __('website.boy') : __('website.girl');
    }
}
