<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'meta_title',
        'slug',
        'description',
        'meta_keyword',
        'meta_descrip'
    ];
}
