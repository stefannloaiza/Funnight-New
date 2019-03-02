<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    
    public $timestamps = true;
    
    //relacion de muchos a uno
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
