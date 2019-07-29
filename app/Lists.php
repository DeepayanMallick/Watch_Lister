<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
   
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function items() 
    {
        return $this->hasMany('App\Item');
    }

    public function shares() 
    {
        return $this->hasMany('App\Share');
    }


}
