<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Enums\UserRole;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LecturerController extends Controller
{
    public function index(Request $request): View
    {
        $query = Lecturer::with('user')->latest();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('employee_id', 'like', "%{$s}%")
                    ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$s}%")->orWhere('email', 'like', "%{$s}%"));
            });
        }

        $lecturers = $query->paginate(15)->withQueryString();
        return view('admin.lecturers.index', compact('lecturers'));
    }

    public function create(): View
    {
        return view('admin.lecturers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'employee_id' => ['required', 'string', 'max:64', 'unique:lecturers,employee_id'],
            'phone' => ['nullable', 'string', 'max:32'],
            'department' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:64'],
        ]);

        $user = User::create([
            'name' => $valid['name'],
            'email' => $valid['email'],
            'password' => bcrypt($valid['password']),
            'role' => UserRole::Lecturer,
        ]);

        Lecturer::create([
            'user_id' => $user->id,
            'employee_id' => $valid['employee_id'],
            'phone' => $valid['phone'] ?? null,
            'department' => $valid['department'] ?? null,
            'title' => $valid['title'] ?? null,
        ]);

        return redirect()->route('admin.lecturers.index')->with('success', 'Lecturer created.');
    }

    public function show(Lecturer $lecturer): View
    {
        $lecturer->load(['user', 'units']);
        return view('admin.lecturers.show', compact('lecturer'));
    }

    public function edit(Lecturer $lecturer): View
    {
        $lecturer->load('user');
        return view('admin.lecturers.edit', compact('lecturer'));
    }

    public function update(Request $request, Lecturer $lecturer): RedirectResponse
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$lecturer->user_id],
            'employee_id' => ['required', 'string', 'max:64', 'unique:lecturers,employee_id,'.$lecturer->id],
            'phone' => ['nullable', 'string', 'max:32'],
            'department' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:64'],
        ]);

        $lecturer->user->update([
            'name' => $valid['name'],
            'email' => $valid['email'],
        ]);
        $lecturer->update([
            'employee_id' => $valid['employee_id'],
            'phone' => $valid['phone'] ?? null,
            'department' => $valid['department'] ?? null,
            'title' => $valid['title'] ?? null,
        ]);

        return redirect()->route('admin.lecturers.index')->with('success', 'Lecturer updated.');
    }

    public function destroy(Lecturer $lecturer): RedirectResponse
    {
        $lecturer->units()->detach();
        $lecturer->user->delete();
        return redirect()->route('admin.lecturers.index')->with('success', 'Lecturer removed.');
    }
}
