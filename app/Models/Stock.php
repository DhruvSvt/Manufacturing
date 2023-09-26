<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'purchase_id',
        'quantity',
        'type',
        'expiry_date',
    ];
   
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
        // return $this->morphMany(Purchase::class, 'commentable');
    }

    use HasFactory;

}
