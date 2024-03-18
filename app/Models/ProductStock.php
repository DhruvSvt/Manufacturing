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
        'supplier_id',
        'price',
        'batch_no',
        'bill_no',
        'bill_date'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function supplier(){
        return $this->belongsTo(Suppliers::class,'supplier_id');
    }
}
