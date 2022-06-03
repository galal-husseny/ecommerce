<?php

namespace App\Models;

use App\Models\Spec;
use Kalnoy\Nestedset\NodeTrait;
use App\Traits\EscapeUniCodeJson;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasTranslatableSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,
        NodeTrait,
        HasTranslations,
        EscapeUniCodeJson,
        HasTranslatableSlug;

    protected $fillable = ['name', 'status', 'slug','_lft','_rgt','parent_id'];
    public $translatable = ['name', 'slug'];
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
