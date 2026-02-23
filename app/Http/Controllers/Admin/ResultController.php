<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResultController extends Controller
{
    public function index(Request $request): View
    {
        $query = Enrollment::with(['student.user', 'unit', 'grade'])
            ->where('status', 'enrolled')
            ->latest();

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
        if ($request->filled('unit_id')) {
            $query->where('unit_id', $request->unit_id);
        }

        $enrollments = $query->paginate(20)->withQueryString();
        $units = Unit::where('status', 'active')->orderBy('code')->get();
        return view('admin.results.index', compact('enrollments', 'units'));
    }

    public function grades(Request $request): View
    {
        $query = Grade::with(['enrollment.student.user', 'enrollment.unit'])->latest();

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        $grades = $query->paginate(20)->withQueryString();
        return view('admin.results.grades', compact('grades'));
    }

    public function settings(): View
    {
        return view('admin.results.settings');
    }

    public function reports(): View
    {
        $gradeDistribution = Grade::selectRaw('grade, count(*) as total')
            ->groupBy('grade')
            ->orderBy('grade')
            ->get();

        return view('admin.results.reports', compact('gradeDistribution'));
    }
}
