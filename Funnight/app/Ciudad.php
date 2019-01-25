<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    //
    protected $table = 'Ciudad';
    protected $fillable = ['nombre', 'paisId'];
}
