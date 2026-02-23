@php
    $currentSessionId = $currentSessionId ?? request()->session()->getId();
@endphp
<section>
    <header>
        <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-sky-100 text-sky-600"><i class="fa-solid fa-mobile-screen text-sm"></i></span>
            {{ __('Active devices & sessions') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Manage where you\'re signed in. Revoke any session you don\'t recognize or sign out from all other devices.') }}
        </p>
    </header>

    <div class="mt-6 space-y-4">
        @if($sessions->isEmpty())
            <p class="text-sm text-gray-500">No active sessions to show.</p>
        @else
            <ul class="divide-y divide-gray-200 rounded-lg border border-gray-200 overflow-hidden">
                @foreach($sessions as $session)
                    <li class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4 bg-gray-50/50 hover:bg-gray-50">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-900">{{ $session->device_name }}</span>
                                @if($session->is_current)
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">This device</span>
                                @endif
                            </div>
                            <p class="mt-0.5 text-sm text-gray-500">
                                {{ $session->ip_address ?? '—' }}
                                · Last active {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}
                            </p>
                        </div>
                        @if(!$session->is_current && config('session.driver') === 'database')
                            <form action="{{ route('profile.sessions.revoke', $session->id) }}" method="post" class="shrink-0"
                                  onsubmit="event.preventDefault(); window.confirmDelete(this, 'Sign out this device?', 'That device will need to sign in again.'); return false;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-md border border-red-200 bg-white px-3 py-1.5 text-sm font-medium text-red-700 hover:bg-red-50">
                                    Revoke
                                </button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>

            @if($sessions->where('is_current', false)->isNotEmpty() || config('session.driver') !== 'database')
                <div class="rounded-lg border border-amber-200 bg-amber-50/50 p-4">
                    <h3 class="text-sm font-medium text-amber-900">Sign out from all other devices</h3>
                    <p class="mt-1 text-sm text-amber-800">
                        @if(config('session.driver') === 'database')
                            Enter your password to invalidate every other session. You will stay signed in on this device.
                        @else
                            If you're signed in on another device, enter your password here to sign those out. You will stay signed in on this device.
                        @endif
                    </p>
                    <form method="post" action="{{ route('profile.logout-other-devices') }}" class="mt-4 flex flex-wrap items-end gap-3">
                        @csrf
                        <div class="min-w-0 flex-1 sm:max-w-xs">
                            <label for="logout_password" class="sr-only">Password</label>
                            <input id="logout_password" name="password" type="password" required
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                   placeholder="{{ __('Password') }}">
                            @error('password', 'logoutOtherDevices')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="rounded-md bg-amber-600 px-4 py-2 text-sm font-medium text-white hover:bg-amber-500">
                            Sign out other devices
                        </button>
                    </form>
                </div>
            @endif
        @endif
    </div>
</section>
