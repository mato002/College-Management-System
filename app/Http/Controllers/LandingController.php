<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Unit;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function __invoke(): View
    {
        $stats = [
            'students' => Student::count(),
            'lecturers' => Lecturer::count(),
            'units' => Unit::where('status', 'active')->count(),
        ];

        $school = [
            'name' => config('school.name'),
            'tagline' => config('school.tagline'),
            'about' => config('school.about'),
            'mission' => config('school.mission'),
            'vision' => config('school.vision'),
            'history' => config('school.history'),
            'address' => config('school.address'),
            'phone' => config('school.phone'),
            'email' => config('school.email'),
            'founded' => config('school.founded'),
            'programs' => config('school.programs'),
            'departments' => config('school.departments', []),
        ];

        $latestNews = Announcement::with('user')
            ->where('scope', 'global')
            ->where(function ($q) {
                $q->where('type', 'news')->orWhereNull('type');
            })
            ->latest()
            ->take(4)
            ->get();

        $latestNotices = Announcement::with('user')
            ->where('scope', 'global')
            ->where('type', 'notice')
            ->latest()
            ->take(3)
            ->get();

        return view('landing', compact('stats', 'school', 'latestNews', 'latestNotices'));
    }
}
