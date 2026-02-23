<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MyUnitController extends Controller
{
    public function index(): View
    {
        $student = auth()->user()->student;
        $enrollments = $student
            ? $student->enrollments()->with(['unit.timetableSlots'])->where('status', 'enrolled')->latest()->get()
            : collect();

        return view('student.my-units.index', compact('enrollments'));
    }
}
