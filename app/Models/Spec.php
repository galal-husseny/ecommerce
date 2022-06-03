<?php

namespace App\Models;

use App\Models\Category;
use App\Traits\EscapeUniCodeJson;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasTranslatableSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spec extends Model
{
    use HasFactory,HasTranslations,EscapeUniCodeJson;

    protected $fillable = ['name'];
    public $translatable = ['name'];
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
