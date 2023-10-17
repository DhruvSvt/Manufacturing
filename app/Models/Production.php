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
        'expiry_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function product_material()
    {
        return $this->belongsTo(ProductRawMaterial::class,'product_id', 'product_id');
    }

    public function finish_raw_material()
    {
        return $this->hasMany(FinalUsedRawMatrial::class,'production_id');
    }

    public function product_raw_material()
    {
        return $this->hasMany(ProductRawMaterial::class,'product_id', 'product_id');
    }
}
