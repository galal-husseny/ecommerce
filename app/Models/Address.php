<?php

namespace App\Models;

use App\Models\User;
use App\Models\Region;
use App\Traits\EscapeUniCodeJson;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory, HasTranslations,
    EscapeUniCodeJson;
    protected $fillable = [
        'street',
        'flat',
        'floor',
        'building',
        'latitude',
        'longitude',
        'region_id',
        'notes',
        'user_id'
    ];
    protected $translatable = ['city_name','region_name'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
