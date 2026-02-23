<x-guest-layout title="Forgot password" heading="Reset password" headingSub="Enter your email and we'll send you a reset link">
    <div class="mb-4 text-sm text-gray-600">
        Forgot your password? Enter your email address and we will send you a link to choose a new password.
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-input-error :messages="$errors->get('email')" class="mb-4" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="Email address" />
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   placeholder="e.g. you@school.ac.ke"
                   class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 placeholder:text-gray-400" />
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Email password reset link
            </button>
        </div>
    </form>

    <x-slot name="footer">
        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Back to log in</a>
    </x-slot>
</x-guest-layout>
