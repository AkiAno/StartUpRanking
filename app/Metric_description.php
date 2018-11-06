<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metric_description extends Model
{
    protected $table = 'metric_descriptions';
    protected $guarded = [];

    public function network() 
    {
        return $this->belongsTo('App\Network','network_id','id');
    }

    public function metric_value() 
    {
        return $this->hasMany('App\Metric_value','metric_description_id','id');
    }
}
