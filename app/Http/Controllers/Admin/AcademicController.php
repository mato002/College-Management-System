<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\Semester;
use App\Models\TimetableSlot;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AcademicController extends Controller
{
    public function calendar(): View
    {
        $semesters = Semester::orderBy('start_date')->get();
        return view('admin.academic.calendar', compact('semesters'));
    }

    public function semesters(): View
    {
        $semesters = Semester::orderBy('start_date')->get();
        return view('admin.academic.semesters', compact('semesters'));
    }

    public function updateSemester(Request $request, Semester $semester): RedirectResponse
    {
        $request->validate([
            'registration_deadline' => 'nullable|date',
            'is_current' => 'boolean',
        ]);
        $semester->update([
            'registration_deadline' => $request->filled('registration_deadline') ? $request->registration_deadline : null,
            'is_current' => $request->boolean('is_current'),
        ]);
        if ($request->boolean('is_current')) {
            Semester::where('id', '!=', $semester->id)->update(['is_current' => false]);
        }
        return redirect()->route('admin.academic.semesters')->with('success', 'Semester updated.');
    }

    public function timetable(): View
    {
        $slots = TimetableSlot::with('unit')->orderBy('day_of_week')->orderBy('start_time')->get();
        return view('admin.academic.timetable', compact('slots'));
    }

    public function departments(): View
    {
        $departments = Lecturer::whereNotNull('department')
            ->where('department', '!=', '')
            ->distinct()
            ->pluck('department')
            ->sort()
            ->values();

        return view('admin.academic.departments', compact('departments'));
    }

    public function programs(): View
    {
        $programs = \App\Models\Student::whereNotNull('programme')
            ->where('programme', '!=', '')
            ->distinct()
            ->pluck('programme')
            ->sort()
            ->values();

        return view('admin.academic.programs', compact('programs'));
    }
}
