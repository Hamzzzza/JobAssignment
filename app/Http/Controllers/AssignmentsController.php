<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;

class AssignmentsController extends Controller
{
    //

    public function all()
    {
       // $assignments = Assignment::all();
          
        $assignments = Assignment::with('course')->get();

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

    public function new($id)
    {
        $assignment = Assignment::create(["coure_id"=>$id, "title"=>request()->title,
        "description"=>request()->description]);

        return response()->json([
            "assignment" => $assignment
        ], 200);
    }

}
