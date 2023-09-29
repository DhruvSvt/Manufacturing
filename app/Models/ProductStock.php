<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'type',
        'expiry_date',
    ];
    use HasFactory;
}
