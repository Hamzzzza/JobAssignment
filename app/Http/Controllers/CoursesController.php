<?php

namespace App\Http\Controllers;

use App\Course;
use App\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
   
    public function all()
    {
       // $assignments = Assignment::all();
          
        $courses = Course::all();

        return response()->json([
            "courses" => $courses
        ], 200);
    }

    public function get($id)
    {
        $course = Course::whereId($id)->first();

        return response()->json([
            "course" => $course
        ], 200);
    }

    public function new(Request $request)
    {
        if( Auth::user()->designation=='0') {   
            
            return response()->json([
            "error" => "unauthorized"
        ], 200);        }

        $course = Course::create($request->only(["name", "description",]));

        return response()->json([
            "course" => $course
        ], 200);
    }




    public function getAssignedTasks($id)
    {

        $tasks = Assignment::all()->where('course_id',$id);

        return response()->json([
            "tasks" => $tasks
        ], 200);


    }


}
