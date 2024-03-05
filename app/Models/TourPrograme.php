<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPrograme extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_date',
        'employee_id',
        'start_location',
        'end_location',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

}
