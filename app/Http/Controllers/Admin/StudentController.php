<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Student::with('user')->latest();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('reg_no', 'like', "%{$s}%")
                    ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$s}%")->orWhere('email', 'like', "%{$s}%"));
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $students = $query->paginate(15)->withQueryString();
        return view('admin.students.index', compact('students'));
    }

    public function create(): View
    {
        return view('admin.students.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'reg_no' => ['required', 'string', 'max:64', 'unique:students,reg_no'],
            'phone' => ['nullable', 'string', 'max:32'],
            'programme' => ['nullable', 'string', 'max:255'],
            'year_of_study' => ['nullable', 'integer', 'min:1', 'max:10'],
        ]);

        $user = User::create([
            'name' => $valid['name'],
            'email' => $valid['email'],
            'password' => bcrypt($valid['password']),
            'role' => UserRole::Student,
        ]);

        Student::create([
            'user_id' => $user->id,
            'reg_no' => $valid['reg_no'],
            'phone' => $valid['phone'] ?? null,
            'programme' => $valid['programme'] ?? null,
            'year_of_study' => (int) ($valid['year_of_study'] ?? 1),
            'status' => 'active',
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student created.');
    }

    public function show(Student $student): View
    {
        $student->load(['user', 'enrollments.unit']);
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        $student->load('user');
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student): RedirectResponse
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$student->user_id],
            'reg_no' => ['required', 'string', 'max:64', 'unique:students,reg_no,'.$student->id],
            'phone' => ['nullable', 'string', 'max:32'],
            'programme' => ['nullable', 'string', 'max:255'],
            'year_of_study' => ['nullable', 'integer', 'min:1', 'max:10'],
            'status' => ['required', 'in:active,suspended,graduated'],
        ]);

        $student->user->update([
            'name' => $valid['name'],
            'email' => $valid['email'],
        ]);
        $student->update([
            'reg_no' => $valid['reg_no'],
            'phone' => $valid['phone'] ?? null,
            'programme' => $valid['programme'] ?? null,
            'year_of_study' => (int) $valid['year_of_study'],
            'status' => $valid['status'],
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student updated.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->user->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student removed.');
    }
}
