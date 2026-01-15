<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $title = 'Product Test 123';
        $students = [
            [
                'id' => 3,
                'name' => 'Nguyen Van A',
                'age' => 21,
                'address' => 'Quan 1'
            ],
            [
                'id' => 7,
                'name' => 'Nguyen Thi B',
                'age' => 29,
                'address' => 'Quan 7'
            ],
            [
                'id' => 13,
                'name' => 'Nguyen Thi B',
                'age' => 29,
                'address' => 'Quan 7'
            ]
        ];
         

        //C1:
        // return view('student.index', ['students' => $students, 'title' => $title]);

        //C2:
        return view('student_blade.index')->with('students',$students)->with('title', $title);

        //C3:
        // return view('student.index', compact('title', 'students'));
    }
}
