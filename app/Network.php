<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $table = 'networks';

    public function account() 
    {
        return $this->hasMany('App\Account','network_id','id');
    }

    public function metric_descriptions() 
    {
        return $this->hasMany('App\Metric_description','network_id','id');
    }
}
