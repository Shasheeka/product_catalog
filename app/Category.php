<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'english_name',
    ];

/*    public function products()
    {
        return $this->hasMany('App\Product');
    }*/

    public function subCategory()
    {
        return $this->hasMany('App\SubCategory');
    }

}
