<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackingStock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function packing()
    {
        return $this->belongsTo(Packing::class, 'product_id', 'product_id');
    }

    public function suppliers(){
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }
}
