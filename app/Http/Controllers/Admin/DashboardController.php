<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Enrollment;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Unit;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            'students' => Student::count(),
            'lecturers' => Lecturer::count(),
            'units' => Unit::where('status', 'active')->count(),
            'enrollments' => Enrollment::where('status', 'enrolled')->count(),
            'announcements' => Announcement::count(),
        ];

        $recentEnrollments = Enrollment::with(['student.user', 'unit'])
            ->latest()
            ->take(5)
            ->get();

        $recentAnnouncements = Announcement::with('user')
            ->latest()
            ->take(4)
            ->get();

        $studentsByYear = Student::selectRaw('year_of_study, count(*) as total')
            ->groupBy('year_of_study')
            ->orderBy('year_of_study')
            ->get();

        $topUnitsByEnrollment = Unit::withCount(['enrollments' => fn ($q) => $q->where('status', 'enrolled')])
            ->where('status', 'active')
            ->orderByDesc('enrollments_count')
            ->take(8)
            ->get();

        $chartEnrollmentLabels = $topUnitsByEnrollment->pluck('code')->toArray();
        $chartEnrollmentData = $topUnitsByEnrollment->pluck('enrollments_count')->toArray();
        $chartYearLabels = $studentsByYear->map(fn ($r) => "Year {$r->year_of_study}")->toArray();
        $chartYearData = $studentsByYear->pluck('total')->toArray();

        return view('admin.dashboard', compact(
            'stats',
            'recentEnrollments',
            'recentAnnouncements',
            'studentsByYear',
            'topUnitsByEnrollment',
            'chartEnrollmentLabels',
            'chartEnrollmentData',
            'chartYearLabels',
            'chartYearData'
        ));
    }
}
