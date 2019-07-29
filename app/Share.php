<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    public function lists()
    {
        return $this->belongsTo('App\Lists');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
