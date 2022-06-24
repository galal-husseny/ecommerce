<?php

namespace App\Models;

use App\Traits\EscapeUniCodeJson;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSpec extends Pivot
{
    use HasTranslations,
        EscapeUniCodeJson;
    protected $table = "product_spec";
    public $translatable = ['value'];
}
