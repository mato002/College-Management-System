<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $lecturer = auth()->user()->lecturer;
        $units = $lecturer
            ? $lecturer->units()->withCount(['enrollments' => fn ($q) => $q->where('status', 'enrolled')])->get()
            : collect();

        $totalStudents = $units->sum('enrollments_count');
        $unitIds = $units->pluck('id');

        $recentAnnouncements = Announcement::where('user_id', auth()->id())
            ->orWhereIn('unit_id', $unitIds)
            ->with('unit')
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'units' => $units->count(),
            'students' => $totalStudents,
            'announcements' => Announcement::where('user_id', auth()->id())->count(),
        ];

        return view('lecturer.dashboard', compact('units', 'recentAnnouncements', 'stats'));
    }
}
