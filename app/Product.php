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
        'id',
        'photo',
        'name',
        'category_id',
        'description',
        'price',
        'brand_id',
        'ages',
        'specification',
        'english_name',
        'precautions',
        'instructions',
        'ingredients',
        'photo_url',
        'page_url',
    ];

    public function SubCategory()
    {
        return $this->belongsTo('App\SubCategory', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public static function getRequiredColumns()
    {
        return [
            'id',
            'photo',
            'name',
            'category_id',
            'description',
            'price',
            'brand_id',
            'ages',
            'specification',
            'english_name',
            'precautions',
            'instructions',
            'ingredients',
            'photo_url',
            'page_url',
        ];
    }

}


