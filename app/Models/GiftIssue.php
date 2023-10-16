<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftIssue extends Model
{
    protected $fillable = ([
        'gift_id',
        'supplier_id',
        'headquarter_id',
        'qty',
        'amount',
    ]);
    use HasFactory;
}
