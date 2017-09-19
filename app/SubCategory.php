<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'name', 'description', 'english_name', 'category_id'
    ];

    public function category()
    {
        return $this->hasOne('App\Category');
    }
}
