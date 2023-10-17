<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalUsedRawMatrial extends Model
{
    public function raw_material()
    {
        return $this->belongsTo(RawMaterial::class, 'raw_material_id', 'id');
    }
    use HasFactory;
}
