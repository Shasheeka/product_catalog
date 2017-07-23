<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'photo',
        'category', 'brand', 'ages',
        'specification', 'english_name', 'precautions',
        'instructions', 'ingredients', 'photo_url',
        'page_url','price',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

}


