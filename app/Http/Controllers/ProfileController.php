<?php

namespace App\Http\Controllers;

use App\Http\Requests\BiodataUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $sessions = [];
        $currentSessionId = $request->session()->getId();

        if (config('session.driver') === 'database') {
            // Ensure current session is tied to this user (e.g. if they logged in before we set user_id)
            DB::table(config('session.table', 'sessions'))
                ->where('id', $currentSessionId)
                ->update([
                    'user_id' => $user->id,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);

            $sessions = DB::table(config('session.table', 'sessions'))
                ->where('user_id', $user->id)
                ->orderByDesc('last_activity')
                ->get()
                ->map(function ($session) use ($currentSessionId) {
                    return (object) [
                        'id' => $session->id,
                        'ip_address' => $session->ip_address,
                        'user_agent' => $session->user_agent,
                        'last_activity' => $session->last_activity,
                        'is_current' => $session->id === $currentSessionId,
                        'device_name' => $this->parseUserAgent($session->user_agent),
                    ];
                });
        } else {
            // File/cookie driver: only show "this device" and offer logout other devices
            $sessions = collect([
                (object) [
                    'id' => $currentSessionId,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'last_activity' => time(),
                    'is_current' => true,
                    'device_name' => $this->parseUserAgent($request->userAgent()),
                ],
            ]);
        }

        $biodata = $user->profile ?? new \App\Models\UserProfile(['user_id' => $user->id]);

        return view('profile.edit', [
            'user' => $user,
            'sessions' => $sessions,
            'currentSessionId' => $currentSessionId,
            'biodata' => $biodata,
        ]);
    }

    private function parseUserAgent(?string $ua): string
    {
        if (empty($ua)) {
            return 'Unknown device';
        }
        if (preg_match('/Mobile|Android|iPhone|iPad|iPod|webOS|BlackBerry|IEMobile|Opera Mini/i', $ua)) {
            if (preg_match('/Android/i', $ua)) return 'Android device';
            if (preg_match('/iPhone|iPad|iPod/i', $ua)) return 'iOS device';
            return 'Mobile device';
        }
        if (preg_match('/Chrome\/[.\d]+/i', $ua)) return 'Chrome';
        if (preg_match('/Firefox\/[.\d]+/i', $ua)) return 'Firefox';
        if (preg_match('/Safari\/[.\d]+/i', $ua) && !preg_match('/Chrome/i', $ua)) return 'Safari';
        if (preg_match('/Edg\/[.\d]+/i', $ua)) return 'Edge';
        if (preg_match('/Opera|OPR/i', $ua)) return 'Opera';
        return 'Desktop browser';
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's biodata (college-mandatory).
     */
    public function updateBiodata(BiodataUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $profile = $user->profile;

        if (!$profile) {
            $profile = $user->profile()->create($request->validated());
        } else {
            $profile->update($request->validated());
        }

        return Redirect::route('profile.edit')->with('status', 'biodata-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/?account_deleted=1');
    }

    /**
     * Log out from all other devices (invalidates other sessions).
     */
    public function logoutOtherDevices(Request $request): RedirectResponse
    {
        $request->validateWithBag('logoutOtherDevices', [
            'password' => ['required', 'current_password'],
        ]);

        Auth::logoutOtherDevices($request->password);

        return Redirect::route('profile.edit')->with('status', 'sessions-revoked');
    }

    /**
     * Revoke a specific session (e.g. another device).
     */
    public function revokeSession(Request $request, string $id): RedirectResponse
    {
        if (config('session.driver') !== 'database') {
            return Redirect::route('profile.edit')->with('error', 'Session management is not available.');
        }

        $deleted = DB::table(config('session.table', 'sessions'))
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->delete();

        if ($deleted) {
            return Redirect::route('profile.edit')->with('success', 'Session signed out.');
        }

        return Redirect::route('profile.edit')->with('error', 'Session not found or already invalid.');
    }
}
