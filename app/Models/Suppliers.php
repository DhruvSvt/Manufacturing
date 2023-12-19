<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'company_name',
        'address',
        'type'
    ];
    use HasFactory;
}
