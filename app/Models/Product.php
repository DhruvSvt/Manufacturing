<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function raw_material()
    {
        return $this->belongsToMany(RawMaterial::class, 'product_raw_materials','product_id','raw_material_id')
                ->select('raw_materials.*','qty');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class,'unit_id','id');
    }

    public function itemStocks(){
        return $this->hasMany(ProductStock::class,'product_id','id');
    }


    public function getStockCountAttribute(){
        return $this->itemStocks->sum('quantity');
    }
}
