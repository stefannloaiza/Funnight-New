<?php

namespace App;

use willvincent\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use Rateable;

    protected $table = 'Images';

    //relacion one to many/ de uno a muchos
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }
    //relacion ony to many likes
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    //relacion de muchos a uno many to one
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
