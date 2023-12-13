<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    use HasFactory;

    public function party(){
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
