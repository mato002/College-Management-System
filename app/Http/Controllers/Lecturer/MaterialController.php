<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function index(): View
    {
        $lecturer = auth()->user()->lecturer;
        $units = $lecturer ? $lecturer->units()->orderBy('code')->get() : collect();

        return view('lecturer.materials.index', compact('units'));
    }
}
