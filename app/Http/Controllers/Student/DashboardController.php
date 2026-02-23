<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Grade;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $student = auth()->user()->student;
        $enrollments = $student
            ? $student->enrollments()->with(['unit', 'grades'])->where('status', 'enrolled')->latest()->get()
            : collect();

        $unitIds = $enrollments->pluck('unit_id');
        $recentAnnouncements = Announcement::where('scope', 'global')
            ->orWhereIn('unit_id', $unitIds)
            ->with('unit')
            ->latest()
            ->take(5)
            ->get();

        $upcomingSlots = collect();
        if ($student) {
            foreach ($enrollments as $e) {
                $e->unit->load('timetableSlots');
                foreach ($e->unit->timetableSlots ?? [] as $slot) {
                    $upcomingSlots->push((object) ['unit' => $e->unit, 'slot' => $slot]);
                }
            }
            $upcomingSlots = $upcomingSlots->take(5);
        }

        $grades = $enrollments->flatMap->grades;

        $averageScore = $grades->count() ? round((float) $grades->avg('score'), 1) : null;
        $completedUnits = $grades->pluck('enrollment_id')->unique()->count();

        $gpa = null;
        if ($grades->count()) {
            $points = $grades->map(function (Grade $g) {
                $score = (float) $g->score;
                if ($score >= 70) return 4.0;
                if ($score >= 60) return 3.0;
                if ($score >= 50) return 2.0;
                if ($score >= 40) return 1.0;
                return 0.0;
            });
            $gpa = round($points->avg(), 2);
        }

        $stats = [
            'units' => $enrollments->count(),
            'completed_units' => $completedUnits,
            'average_score' => $averageScore,
            'gpa' => $gpa,
        ];

        return view('student.dashboard', compact('enrollments', 'recentAnnouncements', 'upcomingSlots', 'stats'));
    }
}
