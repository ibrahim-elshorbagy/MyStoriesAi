<?php

namespace App\Models\Admin\Story;

use App\Models\Admin\Story\Category\AgeCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Story extends Model
{
  protected $guarded = ['id'];

  protected $casts = [
    'title' => 'array',
    'content' => 'array',
    'excerpt' => 'array',
    'gallery_images_ar' => 'array',
    'gallery_images_en' => 'array',
  ];

  protected function getTranslatedValue(array $translations): string
  {
    $locale = app()->getLocale();
    return $translations[$locale] ?? $translations['en'] ?? '';
  }

  protected $appends = ['title_value', 'content_value', 'excerpt_value', 'cover_image_value', 'pdf_value', 'gallery_images_value', 'gender_text'];

  public function getTitleValueAttribute(): string
  {
    return $this->getTranslatedValue($this->title ?? []);
  }

  public function getContentValueAttribute(): string
  {
    return $this->getTranslatedValue($this->content ?? []);
  }

  public function getExcerptValueAttribute(): string
  {
    return $this->getTranslatedValue($this->excerpt ?? []);
  }

  public function getCoverImageValueAttribute(): ?string
  {
    $locale = app()->getLocale();
    $image = $locale === 'ar' ? $this->cover_image_ar : $this->cover_image_en;

    if (!$image) {
      return null;
    }

    // If image is already a full URL, return it
    if (str_starts_with($image, 'http')) {
      return $image;
    }

    // Otherwise, prepend storage path
    return asset('storage/' . $image);
  }

  public function getPdfValueAttribute(): ?string
  {
    $locale = app()->getLocale();
    $pdf = $locale === 'ar' ? $this->pdf_ar : $this->pdf_en;

    if (!$pdf) {
      return null;
    }

    // If PDF is already a full URL, return it
    if (str_starts_with($pdf, 'http')) {
      return $pdf;
    }

    // Otherwise, prepend storage path
    return asset('storage/' . $pdf);
  }

  public function getGalleryImagesValueAttribute(): array
  {
    $locale = app()->getLocale();
    $images = $locale === 'ar' ? ($this->gallery_images_ar ?? []) : ($this->gallery_images_en ?? []);

    // If images are relative paths, prepend storage URL
    return array_map(function ($image) {
      return str_starts_with($image, 'http') ? $image : asset('storage/' . $image);
    }, $images);
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
