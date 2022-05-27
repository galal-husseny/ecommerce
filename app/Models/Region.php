<?php

namespace App\Models;

use App\Models\City;
use App\Traits\EscapeUniCodeJson;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory,
    HasTranslations,
    EscapeUniCodeJson;
    protected $fillable = ['name', 'longitude' ,'latitude', 'radius' ,'city_id','status'];
    public $translatable = ['name'];

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
