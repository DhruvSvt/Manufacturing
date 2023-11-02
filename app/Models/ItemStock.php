<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    protected $fillable = [
        'purchase_id',
        'item_id',
        'quantity',
        'type',
        'expiry_date',
    ];

    public function item()
    {
        return $this->belongsTo(Gift::class,'item_id');
    }

    public function purchase()
    {
        return $this->hasOne(Purchase::class,'id','purchase_id')->where('type', '=' , 'App\Models\Gift');
    }


    use HasFactory;
}
