<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'qty'];
    
    //making a one to one relationship with products 
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
