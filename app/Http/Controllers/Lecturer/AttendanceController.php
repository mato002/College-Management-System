<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function index(Request $request): View
    {
        $lecturer = auth()->user()->lecturer;
        $units = $lecturer ? $lecturer->units()->orderBy('code')->get() : collect();

        return view('lecturer.attendance.index', compact('units'));
    }
}
