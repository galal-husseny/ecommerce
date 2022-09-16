<?php

namespace App\Models;

use App\Models\Spec;
use App\Models\User;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Category;
use App\Models\ProductSpec;
use App\Traits\ProductSpecs;
use App\Traits\ProductImages;
use App\Traits\EscapeUniCodeJson;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasTranslatableSlug;
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

    public $fillable = ['name', 'status', 'slug','description',
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
        return $this->belongsToMany(Spec::class)->using(ProductSpec::class)->withTimestamps();
    }

    public function reviews()
    {
        return $this->belongsToMany(User::class,'reviews','product_id','user_id')->withPivot('rate','comment')->withTimestamps();
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class)->withPivot('discount')->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function model()
    {
        return $this->belongsTo(Models::class,'model_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

}
