<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->input('q', ''));
        $user = $request->user();
        $type = method_exists($user, 'effectiveType') ? $user->effectiveType() : 'student';

        $students = collect();
        $lecturers = collect();
        $units = collect();

        if ($q !== '') {
            // Admins: search everything
            if ($type === 'admin') {
                $students = Student::with('user')
                    ->where(function ($query) use ($q) {
                        $query->where('reg_no', 'like', "%{$q}%")
                            ->orWhere('phone', 'like', "%{$q}%")
                            ->orWhereHas('user', function ($sub) use ($q) {
                                $sub->where('name', 'like', "%{$q}%")
                                    ->orWhere('email', 'like', "%{$q}%");
                            });
                    })
                    ->orderBy('reg_no')
                    ->limit(10)
                    ->get();

                $lecturers = Lecturer::with('user')
                    ->where(function ($query) use ($q) {
                        $query->where('employee_id', 'like', "%{$q}%")
                            ->orWhere('phone', 'like', "%{$q}%")
                            ->orWhere('department', 'like', "%{$q}%")
                            ->orWhereHas('user', function ($sub) use ($q) {
                                $sub->where('name', 'like', "%{$q}%")
                                    ->orWhere('email', 'like', "%{$q}%");
                            });
                    })
                    ->orderBy('employee_id')
                    ->limit(10)
                    ->get();

                $units = Unit::where(function ($query) use ($q) {
                    $query->where('code', 'like', "%{$q}%")
                        ->orWhere('name', 'like', "%{$q}%");
                })
                    ->orderBy('code')
                    ->limit(10)
                    ->get();
            } elseif ($type === 'lecturer') {
                // Lecturers: search own units and students in those units
                $lecturer = $user->lecturer;
                if ($lecturer) {
                    $unitIds = $lecturer->units()->pluck('units.id');

                    $units = Unit::whereIn('id', $unitIds)
                        ->where(function ($query) use ($q) {
                            $query->where('code', 'like', "%{$q}%")
                                ->orWhere('name', 'like', "%{$q}%");
                        })
                        ->orderBy('code')
                        ->limit(10)
                        ->get();

                    $students = Student::with('user')
                        ->whereHas('enrolledUnits', function ($query) use ($unitIds) {
                            $query->whereIn('units.id', $unitIds);
                        })
                        ->where(function ($query) use ($q) {
                            $query->where('reg_no', 'like', "%{$q}%")
                                ->orWhere('phone', 'like', "%{$q}%")
                                ->orWhereHas('user', function ($sub) use ($q) {
                                    $sub->where('name', 'like', "%{$q}%")
                                        ->orWhere('email', 'like', "%{$q}%");
                                });
                        })
                        ->orderBy('reg_no')
                        ->limit(10)
                        ->get();
                }
            } else {
                // Students: search units only
                $units = Unit::where(function ($query) use ($q) {
                    $query->where('code', 'like', "%{$q}%")
                        ->orWhere('name', 'like', "%{$q}%");
                })
                    ->orderBy('code')
                    ->limit(10)
                    ->get();
            }
        }

        return view('search.index', [
            'query' => $q,
            'type' => $type,
            'students' => $students,
            'lecturers' => $lecturers,
            'units' => $units,
        ]);
    }
}

