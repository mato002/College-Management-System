<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UnitBookingController extends Controller
{
    public function index(Request $request): View
    {
        $query = Enrollment::with(['student.user', 'unit'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->whereHas('student', fn ($st) => $st->where('reg_no', 'like', "%{$s}%")
                    ->orWhereHas('user', fn ($u) => $u->where('name', 'like', "%{$s}%")->orWhere('email', 'like', "%{$s}%")))
                    ->orWhereHas('unit', fn ($u) => $u->where('code', 'like', "%{$s}%")->orWhere('name', 'like', "%{$s}%"));
            });
        }

        $bookings = $query->paginate(20)->withQueryString();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function reports(): View
    {
        $byUnitRaw = DB::table('enrollments')
            ->selectRaw('unit_id, semester, status, count(*) as total')
            ->groupBy('unit_id', 'semester', 'status')
            ->get();

        $unitIds = $byUnitRaw->pluck('unit_id')->unique()->filter();
        $units = Unit::whereIn('id', $unitIds)->get()->keyBy('id');

        $bySemester = DB::table('enrollments')
            ->selectRaw('semester, status, count(*) as total')
            ->groupBy('semester', 'status')
            ->get()
            ->groupBy('semester');

        return view('admin.bookings.reports', compact('byUnitRaw', 'units', 'bySemester'));
    }
}
