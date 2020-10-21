<?php

namespace App\Http\Controllers;

use App\User;
use App\Course;
use App\Assignment;
use App\Usercourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
   
    public function all()
    {
       // $assignments = Assignment::all();
          
        $courses = Course::all();
        
        $students=User::where("designation","0")->get();

        return response()->json([
            "courses" => $courses,
            "students"=>$students
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



    public function enrollStudent()
    {
   

        Course::findOrFail(request()->course_id);
        User::findOrFail(request()->user_id);
        

        //dump("working");
        $enroll = Usercourse::updateOrCreate(request()->all());

        return response()->json([
            "enroll" => $enroll
        ], 200);                

    }


    public function addAssignment()
    {
   

        Course::findOrFail(request()->course_id);

        $assignment = Assignment::create(["course_id"=>request()->course_id, "title"=>request()->title,
        "description"=>request()->description,"total_marks"=>request()->total_marks,"due_date"=>request()->due_date]);

        return response()->json([
            "assignment" => $assignment
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
