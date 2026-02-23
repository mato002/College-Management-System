<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TimetableController extends Controller
{
    public function index(): View
    {
        $lecturer = auth()->user()->lecturer;
        $units = $lecturer
            ? $lecturer->units()->with('timetableSlots')->orderBy('code')->get()
            : collect();

        return view('lecturer.timetable.index', compact('units'));
    }
}
