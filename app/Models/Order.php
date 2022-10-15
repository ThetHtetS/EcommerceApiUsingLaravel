<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'address',
        'town',
        'state',
        'status',
        'remark'
    ];
    protected $with =['orderitems'];
 public function orderitems(){
        return($this->hasMany(orderitems::class, 'order_id', 'id'));
    }
    /* protected $with =['product'];
    public function product(){
        return($this->belongsToMany(Product::class, 'orderitems'));
    }*/
    
}
