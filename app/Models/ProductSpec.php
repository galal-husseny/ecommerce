<?php

namespace App\Models;

use App\Traits\EscapeUniCodeJson;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSpec extends Model
{
    use HasFactory,
        HasTranslations,
        EscapeUniCodeJson;
    protected $table = "product_spec";

    protected $fillable = ['spec_id', 'product_id', 'value'];
    public $translatable = ['value'];
}
