<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Http\Resources\Student as StudentResource;
class ApiController extends Controller
{
    //
    public function store(Request $request){
        $students = new Student;
        $students->fname = $request->input('fname');
        $students->lname = $request->input('lname');
        $students->email = $request->input('email');
        $students->class = $request->input('class');
        $students->save();
        return new StudentResource($students);
    }
    public function show(){
        $students = Student::all();
        return StudentResource::collection($students);
    }
    public function showbyid($id){
        $students = Student::find($id);
        if($students){
            return new StudentResource($students);
        }
        else{
            return response()->json(['Error'=>'Invalid ID']);
        }
    }
    public function update(Request $request,$id){
        $students = Student::find($id);
        if($students){
            $students->fname = $request->input('fname');
            $students->lname = $request->input('lname');
            $students->email = $request->input('email');
            $students->class = $request->input('class');

            $students->save();
            return new StudentResource($students);
        }
        else{
            return response()->json(['Error' => 'Invalid User']);
        }
    }
    public function delete($id){
        $students = Student::find($id);
        if($students){
            $students->delete();
            return new StudentResource($students);
        }
        else{
            return response()->json(['Error' => 'No data found']);
        }
    }
}
