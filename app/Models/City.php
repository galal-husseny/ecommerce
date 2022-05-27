<?php

namespace App\Models;

use App\Models\Region;
use App\Traits\EscapeUniCodeJson;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory,
    HasTranslations,
    EscapeUniCodeJson;
    protected $fillable = ['name', 'status'];
    public $translatable = ['name'];
    public function regions()
    {
        $this->hasMany(Region::class);
    }
}
