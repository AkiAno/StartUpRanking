<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metric_value extends Model
{
    protected $table = 'metric_values';
    protected $guarded = [];

    public function account() 
    {
        return $this->belongsTo('App\Account','account_id','id');
    }

    public function metric_description() 
    {
        return $this->belongsTo('App\Metric_description','metric_description_id','id');
    }
}
