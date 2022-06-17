<?php

namespace App\Models;

use App\Traits\EscapeUniCodeJson;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasTranslatableSlug;
use App\Traits\ProductImages;
use App\Traits\ProductSpecs;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        HasTranslations,
        EscapeUniCodeJson,
        HasTranslatableSlug,
        ProductSpecs,
        ProductImages;

    protected $fillable = ['name', 'status', 'slug','description',
    'code','price','quantity','model_id','category_id','shop_id'];
    public $translatable = ['name', 'slug','description','brand_name','value','category_name','model_name'];
    // /**
    //  * Get the options for generating the slug.
    //  */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }

    public function specs()
    {
        return $this->belongsToMany(Spec::class);
    }

}
