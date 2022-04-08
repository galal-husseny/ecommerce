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

class Models extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        HasTranslations,
        EscapeUniCodeJson,
        HasTranslatableSlug;
    protected $table = 'models';

    protected $fillable = ['name', 'status', 'slug','year','brand_id'];
    public $translatable = ['name', 'slug'];
    // /**
    //  * Get the options for generating the slug.
    //  */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }
}
