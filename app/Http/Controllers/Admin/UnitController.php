<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UnitController extends Controller
{
    public function index(Request $request): View
    {
        $query = Unit::withCount('enrollments')->latest();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn ($q) => $q->where('code', 'like', "%{$s}%")->orWhere('name', 'like', "%{$s}%"));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $units = $query->paginate(15)->withQueryString();
        return view('admin.units.index', compact('units'));
    }

    public function create(): View
    {
        return view('admin.units.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $valid = $request->validate([
            'code' => ['required', 'string', 'max:32', 'unique:units,code'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'semester' => ['nullable', 'string', 'max:32'],
            'capacity' => ['nullable', 'integer', 'min:0'],
            'credits' => ['nullable', 'integer', 'min:1', 'max:30'],
            'status' => ['required', 'in:active,archived'],
        ]);

        Unit::create([
            'code' => $valid['code'],
            'name' => $valid['name'],
            'description' => $valid['description'] ?? null,
            'semester' => $valid['semester'] ?? null,
            'capacity' => (int) ($valid['capacity'] ?? 0),
            'credits' => (int) ($valid['credits'] ?? 3),
            'status' => $valid['status'],
        ]);

        return redirect()->route('admin.units.index')->with('success', 'Unit created.');
    }

    public function show(Unit $unit): View
    {
        $unit->load(['lecturers.user', 'enrollments.student.user']);
        return view('admin.units.show', compact('unit'));
    }

    public function edit(Unit $unit): View
    {
        return view('admin.units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit): RedirectResponse
    {
        $valid = $request->validate([
            'code' => ['required', 'string', 'max:32', 'unique:units,code,'.$unit->id],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'semester' => ['nullable', 'string', 'max:32'],
            'capacity' => ['nullable', 'integer', 'min:0'],
            'credits' => ['nullable', 'integer', 'min:1', 'max:30'],
            'status' => ['required', 'in:active,archived'],
        ]);

        $unit->update([
            'code' => $valid['code'],
            'name' => $valid['name'],
            'description' => $valid['description'] ?? null,
            'semester' => $valid['semester'] ?? null,
            'capacity' => (int) ($valid['capacity'] ?? 0),
            'credits' => (int) ($valid['credits'] ?? 3),
            'status' => $valid['status'],
        ]);

        return redirect()->route('admin.units.index')->with('success', 'Unit updated.');
    }

    public function destroy(Unit $unit): RedirectResponse
    {
        $unit->lecturers()->detach();
        $unit->enrollments()->delete();
        $unit->announcements()->delete();
        $unit->timetableSlots()->delete();
        $unit->delete();
        return redirect()->route('admin.units.index')->with('success', 'Unit removed.');
    }
}
