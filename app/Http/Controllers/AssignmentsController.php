<?php

namespace App\Http\Controllers;

use App\Assignment;
use App\Usercourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignmentsController extends Controller
{
    //

    public function all()
    {
       // $assignments = Assignment::all();
          

       $assignments=  Usercourse::with('assignment','course')->where("user_id",auth()->id())->get();

        //$assignments = Assignment::with('course')->get();
          // dd($assignments);

        return response()->json([
            "assignments" => $assignments
        ], 200);
    }

    public function get($id)
    {
        $assignment = Assignment::whereId($id)->first();

        return response()->json([
            "assignment" => $assignment
        ], 200);
    }
   

    public function studentcourses(){
    
     

          $usercourses=  Usercourse::with('course')->where("user_id",auth()->id())->get();

   
   
        return response()->json([
            "usercourses" => $usercourses
        ], 200);

    }
   

}
