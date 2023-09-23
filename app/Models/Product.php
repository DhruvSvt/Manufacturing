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
}
