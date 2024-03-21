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
        'brand',
        'remark',
        'expiry_date'
    ];
    use HasFactory;

    public function supplier(){
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function brand_name(){
        return $this->belongsTo(Brand::class,'brand');
    }
}
