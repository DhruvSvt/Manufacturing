<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'headquarter_id',
        'qty'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function headquarter()
    {
        return $this->belongsTo(Headquarters::class, 'headquarter_id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
