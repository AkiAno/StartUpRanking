<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function company() 
    {
        return $this->hasMany('App\Company','category_id','id');
    }
}
