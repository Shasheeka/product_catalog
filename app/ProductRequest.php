<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    protected $fillable = [
        'name',
        'description',
        'email',
        'image1',
        'image2',
        'image3',
        'category_id',
    ];

}
