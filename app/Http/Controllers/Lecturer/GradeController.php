<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GradeController extends Controller
{
    public function index(Request $request): View
    {
        $lecturer = auth()->user()->lecturer;
        $unitId = $request->get('unit_id');

        $units = $lecturer ? $lecturer->units()->orderBy('code')->get() : collect();
        $enrollments = collect();

        if ($lecturer && ($unitId || $units->isNotEmpty())) {
            $query = Enrollment::with(['student.user', 'unit', 'grades'])
                ->where('status', 'enrolled')
                ->whereIn('unit_id', $units->pluck('id'));
            if ($unitId) {
                $query->where('unit_id', $unitId);
            }
            $enrollments = $query->orderBy('unit_id')->orderBy('student_id')->paginate(30)->withQueryString();
        }

        return view('lecturer.grades.index', compact('units', 'enrollments'));
    }

    public function edit(Enrollment $enrollment): View
    {
        $this->authorizeLecturerEnrollment($enrollment);
        $enrollment->load(['student.user', 'unit', 'grades']);

        return view('lecturer.grades.edit', compact('enrollment'));
    }

    public function update(Request $request, Enrollment $enrollment): RedirectResponse
    {
        $this->authorizeLecturerEnrollment($enrollment);
        $enrollment->load(['student.user', 'unit']);

        $valid = $request->validate([
            'score' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'grade' => ['nullable', 'string', 'max:8'],
            'semester' => ['nullable', 'string', 'max:32'],
        ]);

        $semester = $valid['semester'] ?? $enrollment->semester ?? 'semester_1';
        $oldGrade = $enrollment->grades()->where('semester', $semester)->first();

        $enrollment->grades()->updateOrCreate(
            ['semester' => $semester],
            [
                'score' => $valid['score'] ?? null,
                'grade' => $valid['grade'] ?? null,
                'entered_by' => auth()->id(),
            ]
        );

        ActivityLog::log(
            'grade.updated',
            "Grade updated for {$enrollment->student->user->name} in {$enrollment->unit->code}",
            Grade::class,
            $enrollment->grades()->where('semester', $semester)->first()?->id,
            $oldGrade ? ['score' => $oldGrade->score, 'grade' => $oldGrade->grade] : null,
            ['score' => $valid['score'] ?? null, 'grade' => $valid['grade'] ?? null]
        );

        return redirect()->route('lecturer.grades.index', ['unit_id' => $enrollment->unit_id])
            ->with('success', 'Grade updated.');
    }

    protected function authorizeLecturerEnrollment(Enrollment $enrollment): void
    {
        $lecturer = auth()->user()->lecturer;
        if (! $lecturer || ! $lecturer->units()->where('units.id', $enrollment->unit_id)->exists()) {
            abort(403, 'You are not assigned to this unit.');
        }
    }
}
