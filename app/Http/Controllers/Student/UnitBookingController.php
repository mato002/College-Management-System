<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Semester;
use App\Models\Setting;
use App\Models\Unit;
use App\Notifications\UnitRegisteredNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UnitBookingController extends Controller
{
    public function index(Request $request): View
    {
        $student = auth()->user()->student;
        if (! $student) {
            return view('student.units.index', ['units' => [], 'myEnrollmentIds' => []]);
        }

        $semester = $request->get('semester', 'semester_1');
        $myEnrollmentIds = $student->enrollments()->where('status', 'enrolled')->pluck('unit_id')->all();

        $units = Unit::where('status', 'active')
            ->withCount(['enrollments' => fn ($q) => $q->where('status', 'enrolled')->where('semester', $semester)])
            ->when($request->filled('search'), fn ($q) => $q->where('code', 'like', '%'.$request->search.'%')->orWhere('name', 'like', '%'.$request->search.'%'))
            ->orderBy('code')
            ->paginate(12)
            ->withQueryString();

        return view('student.units.index', compact('units', 'myEnrollmentIds', 'semester'));
    }

    public function store(Request $request): RedirectResponse
    {
        $student = auth()->user()->student;
        if (! $student) {
            return redirect()->route('student.units.index')->with('error', 'Student profile not found.');
        }

        $valid = $request->validate([
            'unit_id' => ['required', 'exists:units,id'],
            'semester' => ['nullable', 'string', 'max:32'],
        ]);

        $unit = Unit::findOrFail($valid['unit_id']);
        $semester = $valid['semester'] ?? 'semester_1';

        $semesterModel = Semester::forSlug($semester);
        if ($semesterModel && ! $semesterModel->isRegistrationOpen()) {
            return back()->with('error', 'Unit registration has closed for this semester. Deadline was ' . $semesterModel->registration_deadline?->format('M j, Y') . '.');
        }

        $maxUnits = Setting::getInt('max_units_per_semester', 10);
        $currentCount = $student->enrollments()->where('semester', $semester)->where('status', 'enrolled')->count();
        if ($currentCount >= $maxUnits) {
            return back()->with('error', "You may enroll in at most {$maxUnits} units per semester.");
        }

        if ($student->enrollments()->where('unit_id', $unit->id)->where('semester', $semester)->where('status', 'enrolled')->exists()) {
            return back()->with('error', 'You are already enrolled in this unit.');
        }

        if ($unit->isFull($semester)) {
            return back()->with('error', 'This unit is full.');
        }

        $student->enrollments()->create([
            'unit_id' => $unit->id,
            'semester' => $semester,
            'status' => 'enrolled',
            'enrolled_at' => now(),
        ]);

        auth()->user()->notify(new UnitRegisteredNotification($unit, $semester));

        return back()->with('success', "Enrolled in {$unit->name}.");
    }

    public function destroy(Request $request, Unit $unit): RedirectResponse
    {
        $student = auth()->user()->student;
        if (! $student) {
            return back()->with('error', 'Student profile not found.');
        }

        $semester = $request->get('semester', 'semester_1');

        $enrollment = $student->enrollments()
            ->where('unit_id', $unit->id)
            ->where('semester', $semester)
            ->where('status', 'enrolled')
            ->first();

        if (! $enrollment) {
            return back()->with('error', 'Enrollment not found.');
        }

        $enrollment->update(['status' => 'dropped']);
        return back()->with('success', "Dropped {$unit->name}.");
    }
}
