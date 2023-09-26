<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialStock extends Model
{
    protected $fillable = [
        'purchase_id',
        'raw_material_id',
        'quantity',
        'type',
        'expiry_date',
    ];

    public function raw_material()
    {
        return $this->belongsTo(RawMaterial::class,'raw_material_id');
    }
    public function rawMaterialUnit()
    {
        return $this->belongsTo(RawMaterial::class,'raw_material_id');
    }

    use HasFactory;
}
