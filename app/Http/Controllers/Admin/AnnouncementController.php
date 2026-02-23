<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(Request $request): View
    {
        $query = Announcement::with(['user', 'unit'])->latest();

        if ($request->filled('scope')) {
            $query->where('scope', $request->scope);
        }

        $announcements = $query->paginate(15)->withQueryString();
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create(): View
    {
        $units = Unit::where('status', 'active')->orderBy('code')->get();
        return view('admin.announcements.create', compact('units'));
    }

    public function store(Request $request): RedirectResponse
    {
        $valid = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'scope' => ['required', 'in:global,unit'],
            'unit_id' => ['nullable', 'required_if:scope,unit', 'exists:units,id'],
            'type' => ['nullable', 'in:news,notice'],
        ]);

        Announcement::create([
            'title' => $valid['title'],
            'body' => $valid['body'],
            'scope' => $valid['scope'],
            'unit_id' => $valid['scope'] === 'unit' ? $valid['unit_id'] : null,
            'type' => $valid['type'] ?? 'news',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement created.');
    }

    public function show(Announcement $announcement): View
    {
        $announcement->load(['user', 'unit']);
        return view('admin.announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement): View
    {
        $units = Unit::where('status', 'active')->orderBy('code')->get();
        return view('admin.announcements.edit', compact('announcement', 'units'));
    }

    public function update(Request $request, Announcement $announcement): RedirectResponse
    {
        $valid = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'scope' => ['required', 'in:global,unit'],
            'unit_id' => ['nullable', 'required_if:scope,unit', 'exists:units,id'],
            'type' => ['nullable', 'in:news,notice'],
        ]);

        $announcement->update([
            'title' => $valid['title'],
            'body' => $valid['body'],
            'scope' => $valid['scope'],
            'unit_id' => $valid['scope'] === 'unit' ? $valid['unit_id'] : null,
            'type' => $valid['type'] ?? 'news',
        ]);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        $announcement->delete();
        return redirect()->route('admin.announcements.index')->with('success', 'Announcement deleted.');
    }
}
