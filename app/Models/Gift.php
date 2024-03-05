<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    public function parent(){
        return $this->belongsTo(Unit::class,'unit','id');
    }

    public function itemStocks(){
        return $this->hasMany(ItemStock::class,'item_id','id')->where("expiry_date",">",Carbon::now()->format('Y-m-d'));
    }

    public function getStockCountAttribute(){
        return $this->itemStocks->sum('quantity');
    }
}

