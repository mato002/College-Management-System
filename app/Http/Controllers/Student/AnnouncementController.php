<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $student = auth()->user()->student;
        $unitIds = $student ? $student->enrollments()->where('status', 'enrolled')->pluck('unit_id') : collect();

        $announcements = Announcement::where('scope', 'global')
            ->orWhereIn('unit_id', $unitIds)
            ->with('unit')
            ->latest()
            ->paginate(15);

        return view('student.announcements.index', compact('announcements'));
    }
}
