<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usercourse extends Model
{
    //

    protected $guarded=[];

   public function course(){
    return $this->belongsTo('App\Course','course_id','id');
   }
   
   public function assignment(){
    return $this->hasMany('App\Assignment',"course_id","course_id");
   }
   
}
