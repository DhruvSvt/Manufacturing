<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyPayment extends Model
{
    protected $fillable = [
        'type',
        'supplier_id',
        'amt',
        'mode',
        'remark'
    ];
    use HasFactory;

    public function supplier(){
        return $this->belongsTo(Suppliers::class,'supplier_id');
    }
}
