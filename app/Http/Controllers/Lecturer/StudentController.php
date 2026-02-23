<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $lecturer = auth()->user()->lecturer;
        $unitId = $request->get('unit_id');

        $units = $lecturer ? $lecturer->units()->orderBy('code')->get() : collect();
        $enrollments = collect();

        if ($lecturer && ($unitId || $units->isNotEmpty())) {
            $query = Enrollment::with(['student.user', 'unit'])
                ->where('status', 'enrolled')
                ->whereIn('unit_id', $units->pluck('id'));
            if ($unitId) {
                $query->where('unit_id', $unitId);
            }
            $enrollments = $query->orderBy('unit_id')->paginate(20)->withQueryString();
        }

        return view('lecturer.students.index', compact('units', 'enrollments'));
    }
}
