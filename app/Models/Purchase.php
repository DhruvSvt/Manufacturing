<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'type',
        'modal_id',
        'supplier_id',
        'brand',
        'quantity',
        'price',
        'remark',
        'batch_no',
        'expiry_date',
        'bill_qty',
    ];
    use HasFactory;

    public function raw_material()
    {
        return $this->belongsTo(RawMaterial::class,'modal_id');
    }

    public function item()
    {
        return $this->belongsTo(Gift::class,'modal_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'modal_id');
    }

    public function modal(){
        return $this->belongsTo($this->type) ?? '';
    }

    public function supplier(){
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function brand_name(){
        return $this->belongsTo(Brand::class,'brand');
    }

    public function commentable(){
        return $this->morphTo();
    }
}
