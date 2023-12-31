<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Headquarters extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'state',
        'headquarter',
        'region',
    ];
}
