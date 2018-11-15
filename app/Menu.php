<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['type','name','menuorder','parent_id','menu_url'];
}
