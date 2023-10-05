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
        'remark',
        'expiry_date',
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

    public function modal(){    
        return $this->belongsTo($this->type) ?? '';
    }

    public function commentable(){
        return $this->morphTo();
    }
}
