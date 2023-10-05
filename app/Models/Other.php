<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    protected $fillable = [
        'name',
        'supplier_id',
        'quantity',
        'price',
        'remark',
        'expiry_date'
    ];
    use HasFactory;
}
