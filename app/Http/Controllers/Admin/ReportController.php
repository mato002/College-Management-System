<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Unit;
use App\Models\User;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function students(): View
    {
        $total = Student::count();
        $byStatus = Student::selectRaw('status, count(*) as total')->groupBy('status')->get();
        $byYear = Student::selectRaw('year_of_study, count(*) as total')->groupBy('year_of_study')->orderBy('year_of_study')->get();

        return view('admin.reports.students', compact('total', 'byStatus', 'byYear'));
    }

    public function enrollment(): View
    {
        $units = Unit::withCount(['enrollments' => fn ($q) => $q->where('status', 'enrolled')])
            ->orderBy('code')
            ->get();

        $totalEnrolled = Enrollment::where('status', 'enrolled')->count();

        return view('admin.reports.enrollment', compact('units', 'totalEnrolled'));
    }

    public function lecturers(): View
    {
        $total = Lecturer::count();
        $byDepartment = Lecturer::selectRaw('department, count(*) as total')
            ->whereNotNull('department')
            ->where('department', '!=', '')
            ->groupBy('department')
            ->get();

        return view('admin.reports.lecturers', compact('total', 'byDepartment'));
    }

    public function analytics(): View
    {
        $stats = [
            'users' => User::count(),
            'students' => Student::count(),
            'lecturers' => Lecturer::count(),
            'units' => Unit::count(),
            'enrollments' => Enrollment::where('status', 'enrolled')->count(),
        ];

        return view('admin.reports.analytics', compact('stats'));
    }
}
