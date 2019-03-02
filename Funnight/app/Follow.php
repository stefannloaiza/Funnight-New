<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    
    public $timestamps = true;
    
    //relacion de muchos a uno
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
