<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //

   
    protected $guarded=[];


    public function assignment()
    {
        return $this->hasMany('App\Assignment');
    }
}
