<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'short_name',
        'full_name',
        'parent_id',
        'unit',
    ];
    use HasFactory;

    public function parent(){
        return $this->belongsTo(self::class);
    }
}
