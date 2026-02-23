<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <title>@yield('title', $school['name'] ?? config('app.name'))</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|fraunces:500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-fraunces { font-family: 'Fraunces', serif; }
        .font-dm { font-family: 'DM Sans', system-ui, sans-serif; }
    </style>
</head>
<body class="font-dm text-gray-900 antialiased min-h-screen bg-[#fafbfc]">
    @include('layouts.partials.public-header', ['school' => $school ?? ['name' => config('app.name'), 'tagline' => config('school.tagline'), 'email' => config('school.email'), 'phone' => config('school.phone')]])

    <main class="min-h-[60vh]">
        @yield('content')
    </main>

    <footer class="mt-16 border-t border-gray-200 bg-[#006837] px-4 py-14 text-white">
        <div class="mx-auto max-w-6xl">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-5">
                <div class="lg:col-span-2">
                    <h3 class="font-fraunces text-lg font-semibold">{{ $school['name'] ?? config('app.name') }}</h3>
                    <p class="mt-2 text-sm text-white/80">{{ $school['tagline'] ?? '' }}</p>
                    <p class="mt-3 text-sm text-white/70">{{ $school['address'] ?? '' }}</p>
                </div>
                <div>
                    <h3 class="font-fraunces text-sm font-semibold uppercase tracking-wider">About</h3>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li><a href="{{ route('public.about') }}" class="text-white/80 hover:text-white">History & Profile</a></li>
                        <li><a href="{{ route('public.departments') }}" class="text-white/80 hover:text-white">Departments</a></li>
                        <li><a href="{{ route('public.programs') }}" class="text-white/80 hover:text-white">Programmes</a></li>
                        <li><a href="{{ route('public.courses') }}" class="text-white/80 hover:text-white">Courses</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-fraunces text-sm font-semibold uppercase tracking-wider">Admission</h3>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li><a href="{{ route('public.admissions') }}" class="text-white/80 hover:text-white">How To Apply</a></li>
                        <li><a href="{{ route('public.programs') }}" class="text-white/80 hover:text-white">Programmes</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-fraunces text-sm font-semibold uppercase tracking-wider">Info</h3>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li><a href="{{ route('public.news') }}" class="text-white/80 hover:text-white">News & Updates</a></li>
                        <li><a href="{{ route('public.staff') }}" class="text-white/80 hover:text-white">Staff</a></li>
                        <li><a href="{{ route('public.events') }}" class="text-white/80 hover:text-white">Events</a></li>
                        <li><a href="{{ route('public.contact') }}" class="text-white/80 hover:text-white">Contact</a></li>
                        <li><a href="{{ route('public.faq') }}" class="text-white/80 hover:text-white">FAQ</a></li>
                        <li><a href="{{ route('login') }}" class="text-white/80 hover:text-white">Portal</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-white/20 pt-8 sm:flex-row">
                <p class="text-sm text-white/70">© {{ date('Y') }} {{ $school['name'] ?? config('app.name') }}. All rights reserved.</p>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <a href="{{ route('public.about') }}" class="text-white/70 hover:text-white">About</a>
                    <a href="{{ route('public.programs') }}" class="text-white/70 hover:text-white">Programs</a>
                    <a href="{{ route('public.admissions') }}" class="text-white/70 hover:text-white">Admissions</a>
                    <a href="{{ route('public.contact') }}" class="text-white/70 hover:text-white">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    @if(session('success'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.Swal) window.Swal.fire({ icon: 'success', title: 'Success', text: @json(session('success')) });
    });
    </script>
    @endif
    @if(session('error'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.Swal) window.Swal.fire({ icon: 'error', title: 'Error', text: @json(session('error')) });
    });
    </script>
    @endif
</body>
</html>
