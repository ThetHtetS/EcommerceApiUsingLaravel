<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'meta_title',
        'slug',
        'description',
        'meta_keyword',
        'meta_descrip',
        'seeling_price',
        'original_price',
        'brand',
        'qty',
        'image',
        'featured',
        'popular',
        'status'
    ];
 /*   protected $with =['order'];
    public function order(){
        return($this->belongsToMany(Order::class, 'orderitems'));
    }
*/
}
