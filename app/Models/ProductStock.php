<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'product_type',
        'product_id',
        'quantity',
        'type',
        'expiry_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
