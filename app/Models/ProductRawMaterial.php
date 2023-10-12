<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRawMaterial extends Model
{
    use HasFactory;

    public function raw_material()
    {
        return $this->belongsTo(RawMaterial::class,'raw_material_id');
    }

}
