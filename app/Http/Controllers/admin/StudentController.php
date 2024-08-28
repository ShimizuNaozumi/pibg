<?php

namespace App\Http\Controllers\admin;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function students()
    {
        $acc = Auth::guard('admin')->user();
        $students = Student::orderBy('created_at', 'desc')->get();

        return view('admin.students', compact('acc', 'students'));
    }

    public function show_student(string $id)
    {
        $id = decrypt_string($id);
        
        $acc = Auth::guard('admin')->user();

        $student = DB::table('students')
                ->where('student_id', $id)
                ->first();

        $guardians = DB::table('guardians')
                    ->where('user_id', $student->user_id)
                    ->get();

        return view('admin.details_student', compact('acc', 'student', 'guardians'));
    }
}
