<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','street','building','floor','notes','region_id','seller_id','latitude','longitude'
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
