<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UnitLecturerController extends Controller
{
    public function edit(Unit $unit): View
    {
        $unit->load('lecturers');
        $lecturers = Lecturer::with('user')->orderBy('employee_id')->get();
        return view('admin.units.assign-lecturers', compact('unit', 'lecturers'));
    }

    public function update(Request $request, Unit $unit): RedirectResponse
    {
        $valid = $request->validate([
            'lecturers' => ['nullable', 'array'],
            'lecturers.*' => ['exists:lecturers,id'],
            'semester' => ['nullable', 'string', 'max:32'],
        ]);

        $sync = collect($valid['lecturers'] ?? [])->mapWithKeys(fn ($id) => [$id => ['semester' => $valid['semester'] ?? null]])->all();
        $unit->lecturers()->sync($sync);

        return redirect()->route('admin.units.show', $unit)->with('success', 'Lecturers assigned.');
    }
}
