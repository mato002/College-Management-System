<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function index(): View
    {
        $student = auth()->user()->student;
        $enrollments = $student
            ? $student->enrollments()->with('unit')->where('status', 'enrolled')->get()
            : collect();

        return view('student.materials.index', compact('enrollments'));
    }
}
