<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TimetableController extends Controller
{
    public function index(): View
    {
        $student = auth()->user()->student;
        $enrollments = $student
            ? $student->enrollments()->with('unit.timetableSlots')->where('status', 'enrolled')->get()
            : collect();

        return view('student.timetable.index', compact('enrollments'));
    }
}
