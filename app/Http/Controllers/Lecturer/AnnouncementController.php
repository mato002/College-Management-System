<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $lecturer = auth()->user()->lecturer;
        $unitIds = $lecturer ? $lecturer->units()->pluck('units.id') : collect();

        $announcements = Announcement::where('user_id', auth()->id())
            ->orWhereIn('unit_id', $unitIds)
            ->with('unit')
            ->latest()
            ->paginate(15);

        return view('lecturer.announcements.index', compact('announcements'));
    }

    public function create(): View
    {
        $lecturer = auth()->user()->lecturer;
        $units = $lecturer ? $lecturer->units()->orderBy('code')->get() : collect();

        return view('lecturer.announcements.create', compact('units'));
    }

    public function store(Request $request): RedirectResponse
    {
        $lecturer = auth()->user()->lecturer;
        $unitIds = $lecturer ? $lecturer->units()->pluck('units.id')->all() : [];

        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'unit_id' => ['nullable', 'exists:units,id'],
        ];
        if ($unitIds !== []) {
            $rules['unit_id'][] = 'in:'.implode(',', $unitIds);
        }
        $valid = $request->validate($rules);

        Announcement::create([
            'title' => $valid['title'],
            'body' => $valid['body'],
            'user_id' => auth()->id(),
            'unit_id' => $valid['unit_id'] ?? null,
            'scope' => $valid['unit_id'] ? 'unit' : 'global',
        ]);

        return redirect()->route('lecturer.announcements.index')->with('success', 'Announcement posted.');
    }
}
