<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'qty',
        'batch_no',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function product_material()
    {
        return $this->belongsTo(ProductRawMaterial::class,'product_id', 'product_id');
    }

}
