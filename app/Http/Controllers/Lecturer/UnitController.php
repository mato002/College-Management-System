<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UnitController extends Controller
{
    public function index(Request $request): View
    {
        $lecturer = auth()->user()->lecturer;
        $units = $lecturer
            ? $lecturer->units()->withCount(['enrollments' => fn ($q) => $q->where('status', 'enrolled')])->with('timetableSlots')->get()
            : collect();

        return view('lecturer.units.index', compact('units'));
    }

    public function show(Unit $unit): View
    {
        $this->authorizeLecturerUnit($unit);
        $unit->load(['timetableSlots', 'enrollments' => fn ($q) => $q->where('status', 'enrolled')->with('student.user')]);

        return view('lecturer.units.show', compact('unit'));
    }

    protected function authorizeLecturerUnit(Unit $unit): void
    {
        $lecturer = auth()->user()->lecturer;
        if (! $lecturer || ! $lecturer->units()->where('units.id', $unit->id)->exists()) {
            abort(403, 'You are not assigned to this unit.');
        }
    }
}
