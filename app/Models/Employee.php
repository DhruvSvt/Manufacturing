<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ([
        'name',
        'phn_no',
        'designation'
    ]);

    public function tour_programmes()
    {
        return $this->hasMany(TourPrograme::class,'employee_id','id')->where('tour_date',Carbon::now()->format('Y-m-d'));
    }

}
