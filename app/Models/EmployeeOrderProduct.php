<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeOrderProduct extends Model
{
    use HasFactory;

    public function orderProduct()
    {
        return $this->belongsTo(EmployeeOrderProduct::class, 'visit_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
