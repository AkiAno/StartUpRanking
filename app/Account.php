<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';
    protected $guarded = [];

    public function company() 
    {
        return $this->belongsTo('App\Company','company_id','id');
    }

    public function metric_values() 
    {
        return $this->hasMany('App\Metric_value','account_id','id');
    }

    public function network() 
    {
        return $this->belongsTo('App\Network','network_id','id');
    }
}
