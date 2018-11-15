<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'status'];

    
    public function newslist()
    {
        return $this->hasMany('App\News');
    }
}
