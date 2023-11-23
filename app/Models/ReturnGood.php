<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnGood extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'supplier_id',
        'type',
        'batch',
        'type',
        'builty',
        'transport',
        'dispatch',
        'date_of_receipt',
        'quantity',
        'rate',
        'receipt',
    ];

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
