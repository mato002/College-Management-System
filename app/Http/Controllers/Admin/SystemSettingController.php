<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SystemSettingController extends Controller
{
    public function general(): View
    {
        $settings = [
            'app_name' => Setting::get('app_name', config('app.name')),
            'max_units_per_semester' => Setting::get('max_units_per_semester', '8'),
        ];
        return view('admin.settings.general', compact('settings'));
    }

    public function updateGeneral(Request $request): RedirectResponse
    {
        $request->validate([
            'app_name' => 'required|string|max:128',
            'max_units_per_semester' => 'required|integer|min:1|max:20',
        ]);
        Setting::set('app_name', $request->app_name);
        Setting::set('max_units_per_semester', (string) $request->max_units_per_semester);
        return redirect()->route('admin.settings.general')->with('success', 'Settings saved.');
    }

    public function email(): View
    {
        return view('admin.settings.email');
    }

    public function permissions(): View
    {
        return view('admin.settings.permissions');
    }

    public function backup(): View
    {
        return view('admin.settings.backup');
    }
}
