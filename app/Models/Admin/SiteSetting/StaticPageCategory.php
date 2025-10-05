<?php

namespace App\Models\Admin\SiteSetting;

use Illuminate\Database\Eloquent\Model;

class StaticPageCategory extends Model
{
    protected $fillable = ['name'];

    public function staticPages()
    {
        return $this->hasMany(StaticPage::class, 'category_id');
    }
}
