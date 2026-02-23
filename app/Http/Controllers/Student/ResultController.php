<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ResultController extends Controller
{
    public function index(): View
    {
        $student = auth()->user()->student;
        $enrollments = $student
            ? $student->enrollments()->with(['unit', 'grades'])->where('status', 'enrolled')->latest()->get()
            : collect();

        return view('student.results.index', compact('enrollments'));
    }
}
