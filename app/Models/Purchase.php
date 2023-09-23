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
        'quantity',
        'price',  
        'expiry_date',  
    ];
    use HasFactory;

    public function raw_material()
    {
        return $this->belongsTo(RawMaterial::class);
    }
}
