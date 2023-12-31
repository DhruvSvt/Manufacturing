<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftIssue extends Model
{
    use HasFactory;
    protected $fillable = ([
        'gift_id',
        'supplier_id',
        'headquarter_id',
        'employee_id',
        'qty',
        'amount',
    ]);

    public function gift()
    {
        return $this->belongsTo(Gift::class, 'gift_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function headquarter()
    {
        return $this->belongsTo(Headquarters::class, 'headquarter_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
