<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $guarded = [];

    public function account() 
    {
        return $this->hasMany('App\Account','company_id','id');
    }

    public function category() 
    {
        return $this->belongsTo('App\Category','category_id','id');
    }
}
