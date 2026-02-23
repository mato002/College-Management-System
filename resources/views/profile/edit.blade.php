<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">
            {{-- Profile summary card --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200/80">
                <div class="p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                        <div class="flex items-center gap-4 shrink-0">
                            <div class="flex h-20 w-20 sm:h-24 sm:w-24 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-700 text-2xl sm:text-3xl font-bold ring-2 ring-indigo-200/60">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div class="sm:hidden">
                                <h1 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h1>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h1 class="hidden sm:block text-xl font-semibold text-gray-900">{{ $user->name }}</h1>
                            <p class="hidden sm:block text-sm text-gray-500 mt-0.5">{{ $user->email }}</p>
                            <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm">
                                <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 font-medium text-indigo-700">
                                    {{ $user->roleLabel() }}
                                </span>
                                @if($user->created_at)
                                <span class="text-gray-500">Member since {{ $user->created_at->format('F Y') }}</span>
                                @endif
                            </div>
                            @if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <p class="mt-2 text-sm text-amber-700 bg-amber-50 rounded-lg px-3 py-2">
                                Your email is not verified.
                                <button form="send-verification" type="submit" class="underline font-medium hover:no-underline">Resend verification email</button>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Account activity summary (quick stats) --}}
            @if($sessions->isNotEmpty())
            @php
                $lastActive = $sessions->max('last_activity');
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl border border-gray-200/80 p-4 shadow-sm">
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Member since</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->created_at ? $user->created_at->format('M j, Y') : '—' }}</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200/80 p-4 shadow-sm">
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Last active</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $lastActive ? \Carbon\Carbon::createFromTimestamp($lastActive)->diffForHumans() : '—' }}</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200/80 p-4 shadow-sm">
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Active sessions</p>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $sessions->count() }} {{ Str::plural('device', $sessions->count()) }}</p>
                </div>
            </div>
            @endif

            <div class="grid gap-6 lg:grid-cols-1">
                {{-- Biodata (college-mandatory) --}}
                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200/80 overflow-hidden">
                    <div class="p-6 sm:p-8">
                        @include('profile.partials.biodata-form')
                    </div>
                </div>

                {{-- Profile information --}}
                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200/80 overflow-hidden">
                    <div class="p-6 sm:p-8">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                {{-- Update password --}}
                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200/80 overflow-hidden">
                    <div class="p-6 sm:p-8">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- Active devices & sessions --}}
                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200/80 overflow-hidden">
                    <div class="p-6 sm:p-8">
                        @include('profile.partials.browser-sessions', ['sessions' => $sessions, 'currentSessionId' => $currentSessionId])
                    </div>
                </div>

                {{-- Delete account --}}
                <div class="bg-white shadow-sm sm:rounded-xl border border-gray-200/80 overflow-hidden">
                    <div class="p-6 sm:p-8">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
