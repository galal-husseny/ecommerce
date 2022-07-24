<?php

namespace App\Models;

use App\Traits\EscapeUniCodeJson;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasTranslatableSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        HasTranslations,
        EscapeUniCodeJson,
        HasTranslatableSlug;

    protected $fillable = ['title', 'status', 'description','start_at','end_at','max_discount'];
    public $translatable = ['title', 'description'];
    // /**
    //  * Get the options for generating the slug.
    //  */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('discount')->withTimestamps();
    }
}
