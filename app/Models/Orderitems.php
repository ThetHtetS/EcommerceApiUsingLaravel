<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderitems extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'order_id',
        'qty',
        'price'
    ];    
   protected $with =['product'];
    //protected $with =['order'];
    public function product()
    {    return $this->belongsTo(Product::class);
    }

    /*
    public function order()
    {    return $this->belongsTo(Order::class);
    }
    */
}
