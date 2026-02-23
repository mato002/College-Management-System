<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $school['name'] }} — {{ $school['tagline'] }}. {{ Str::limit($school['about'], 120) }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <title>{{ $school['name'] }} — Academic Portal</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|fraunces:500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-fraunces { font-family: 'Fraunces', serif; }
        .font-dm { font-family: 'DM Sans', system-ui, sans-serif; }
        .bg-about { background-image: linear-gradient(to right, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.9) 100%), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=1200&q=70'); background-size: cover; background-position: center; }
        .bg-programs { background-image: linear-gradient(to bottom, rgba(245,247,250,0.92) 0%, rgba(255,255,255,0.95) 100%), url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1200&q=70'); background-size: cover; background-position: center; }
        .bg-students { background-image: linear-gradient(to bottom, rgba(245,247,250,0.9) 0%, rgba(255,255,255,0.95) 100%), url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1200&q=70'); background-size: cover; background-position: center; }
    </style>
</head>
<body class="font-dm text-gray-900 antialiased min-h-screen bg-[#fafbfc]">
    @include('layouts.partials.public-header', ['school' => $school])

    <main>
        {{-- Hero: large banner with sliding images, different content per slide --}}
        <section class="relative h-[70vh] min-h-[450px] overflow-hidden border-b border-gray-200/60"
                 x-data="{ active: 0, interval: null, startTimer() { this.interval = setInterval(() => { this.active = (this.active + 1) % 4 }, 5000) }, resetTimer() { if (this.interval) clearInterval(this.interval); this.startTimer() } }"
                 x-init="startTimer()">
            {{-- Sliding background images --}}
            <div class="absolute inset-0">
                @foreach([
                    'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1920&q=80',
                    'https://images.unsplash.com/photo-1562774053-701939374585?w=1920&q=80',
                    'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=1920&q=80',
                    'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=1920&q=80',
                ] as $i => $img)
                <div x-show="active === {{ $i }}"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-500"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0 bg-cover bg-center"
                     style="background-image: url('{{ $img }}');">
                </div>
                @endforeach
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/40 to-black/60"></div>

            {{-- Per-slide content overlay --}}
            @foreach([
                ['sub' => 'Welcome To', 'title' => $school['name'], 'desc' => $school['tagline']],
                ['sub' => 'Our', 'title' => 'Vision', 'desc' => $school['vision']],
                ['sub' => 'Our', 'title' => 'Mission', 'desc' => $school['mission']],
                ['sub' => 'Our', 'title' => 'History', 'desc' => Str::limit($school['history'] ?? '', 180)],
            ] as $i => $slide)
            <div x-show="active === {{ $i }}"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center z-10">
                <p class="text-sm font-medium uppercase tracking-wider text-white/90 sm:text-base">{{ $slide['sub'] }}</p>
                <h1 class="mt-2 font-fraunces text-4xl font-semibold tracking-tight text-white sm:text-5xl lg:text-6xl drop-shadow-lg">{{ $slide['title'] }}</h1>
                <p class="mx-auto mt-5 max-w-2xl text-base text-white/95 sm:text-lg drop-shadow">{{ $slide['desc'] }}</p>
                <a href="{{ route('public.about') }}" class="mt-8 inline-flex items-center rounded-xl border-2 border-white bg-white/10 px-6 py-3 text-base font-semibold text-white backdrop-blur-sm transition hover:bg-white hover:text-[#006837]">Read More..</a>
            </div>
            @endforeach

            {{-- Slider indicators --}}
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                @for($i = 0; $i < 4; $i++)
                <button type="button"
                        @click="active = {{ $i }}; resetTimer()"
                        class="h-2 rounded-full transition-all duration-300"
                        :class="active === {{ $i }} ? 'w-8 bg-white' : 'w-2 bg-white/50 hover:bg-white/70'"
                        aria-label="Slide {{ $i + 1 }}">
                </button>
                @endfor
            </div>
        </section>

        {{-- Quick-nav tiles (Sigalagala style) --}}
        <section class="border-b border-gray-200/60 bg-white px-4 py-8">
            <div class="mx-auto max-w-6xl">
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">
                    <a href="{{ route('public.about') }}#vision" class="rounded-xl border border-gray-200 bg-[#fafbfc] p-4 text-center transition hover:border-[#006837]/30 hover:shadow-md">
                        <span class="block font-fraunces font-semibold text-[#006837]">Our Vision</span>
                    </a>
                    <a href="{{ route('public.about') }}#mission" class="rounded-xl border border-gray-200 bg-[#fafbfc] p-4 text-center transition hover:border-[#006837]/30 hover:shadow-md">
                        <span class="block font-fraunces font-semibold text-[#006837]">Our Mission</span>
                    </a>
                    <a href="{{ route('public.about') }}" class="rounded-xl border border-gray-200 bg-[#fafbfc] p-4 text-center transition hover:border-[#006837]/30 hover:shadow-md">
                        <span class="block font-fraunces font-semibold text-[#006837]">Our Profile</span>
                    </a>
                    <a href="{{ route('public.programs') }}" class="rounded-xl border border-gray-200 bg-[#fafbfc] p-4 text-center transition hover:border-[#006837]/30 hover:shadow-md">
                        <span class="block font-fraunces font-semibold text-[#006837]">Programmes</span>
                    </a>
                    <a href="{{ route('public.departments') }}" class="rounded-xl border border-gray-200 bg-[#fafbfc] p-4 text-center transition hover:border-[#006837]/30 hover:shadow-md">
                        <span class="block font-fraunces font-semibold text-[#006837]">Departments</span>
                    </a>
                    <a href="{{ route('public.admissions') }}" class="rounded-xl border border-gray-200 bg-[#fafbfc] p-4 text-center transition hover:border-[#006837]/30 hover:shadow-md">
                        <span class="block font-fraunces font-semibold text-[#006837]">Admissions</span>
                    </a>
                </div>
            </div>
        </section>

        {{-- About the institution --}}
        <section id="about" class="border-b border-gray-200/60 bg-about px-4 py-16 sm:py-20">
            <div class="mx-auto max-w-6xl">
                <h2 class="font-fraunces text-center text-2xl font-semibold text-gray-900 sm:text-3xl">
                    About our institution
                </h2>
                <p class="mx-auto mt-3 max-w-2xl text-center text-gray-600">
                    Founded in {{ $school['founded'] }}, we have grown into a vibrant academic community committed to excellence.
                </p>
                <div class="mt-12 grid gap-8 lg:grid-cols-2">
                    <div class="rounded-2xl border border-gray-100 bg-[#fafbfc] p-8">
                        <h3 class="font-fraunces text-lg font-semibold text-[#006837]">Our mission</h3>
                        <p class="mt-3 leading-relaxed text-gray-600">{{ $school['mission'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-[#fafbfc] p-8">
                        <h3 class="font-fraunces text-lg font-semibold text-[#006837]">Our vision</h3>
                        <p class="mt-3 leading-relaxed text-gray-600">{{ $school['vision'] }}</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Programs --}}
        @if(!empty(array_filter($school['programs'])))
        <section class="border-b border-gray-200/60 bg-programs px-4 py-16 sm:py-20">
            <div class="mx-auto max-w-6xl">
                <h2 class="font-fraunces text-center text-2xl font-semibold text-gray-900 sm:text-3xl">
                    Programs & departments
                </h2>
                <p class="mx-auto mt-2 max-w-xl text-center text-gray-600">
                    We offer a wide range of academic programs designed to meet diverse interests and career goals.
                </p>
                <div class="mt-10 flex flex-wrap justify-center gap-3">
                    @foreach($school['programs'] as $program)
                        <span class="rounded-full bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-gray-200/80">{{ $program }}</span>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- News & Updates --}}
        @if(isset($latestNews) && $latestNews->isNotEmpty())
        <section class="border-b border-gray-200/60 bg-white px-4 py-16 sm:py-20">
            <div class="mx-auto max-w-6xl">
                <div class="flex items-center justify-between">
                    <h2 class="font-fraunces text-2xl font-semibold text-gray-900 sm:text-3xl">News & Updates</h2>
                    <a href="{{ route('public.news') }}" class="text-sm font-semibold text-[#006837] hover:underline">News & Updates →</a>
                </div>
                <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($latestNews as $a)
                    <a href="{{ route('public.news.show', $a) }}" class="rounded-xl border border-gray-100 bg-[#fafbfc] p-5 transition hover:border-[#006837]/20 hover:shadow-md">
                        <p class="text-xs font-medium uppercase tracking-wider text-[#006837]">{{ $a->created_at->format('F d, Y') }}</p>
                        <h3 class="mt-2 font-fraunces font-semibold text-gray-900">{{ Str::limit($a->title, 50) }}</h3>
                        <p class="mt-2 text-sm text-gray-600">{{ Str::limit(strip_tags($a->body), 100) }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- Notices and Announcements --}}
        @if(isset($latestNotices) && $latestNotices->isNotEmpty())
        <section class="border-b border-gray-200/60 bg-[#fafbfc] px-4 py-16 sm:py-20">
            <div class="mx-auto max-w-6xl">
                <div class="flex items-center justify-between">
                    <h2 class="font-fraunces text-2xl font-semibold text-gray-900 sm:text-3xl">Notices and Announcements</h2>
                    <a href="{{ route('public.news') }}?type=notice" class="text-sm font-semibold text-[#006837] hover:underline">More Notices →</a>
                </div>
                <div class="mt-8 space-y-4">
                    @foreach($latestNotices as $a)
                    <a href="{{ route('public.news.show', $a) }}" class="block rounded-xl border border-gray-200 bg-white p-5 transition hover:border-[#006837]/20 hover:shadow-sm">
                        <div class="flex flex-wrap items-baseline justify-between gap-2">
                            <p class="text-sm text-gray-500">{{ $a->created_at->format('M d, Y') }}</p>
                            <span class="text-xs font-medium text-[#006837]">Notice</span>
                        </div>
                        <h3 class="mt-2 font-fraunces font-semibold text-gray-900">{{ $a->title }}</h3>
                        <p class="mt-1 text-sm text-gray-600">{{ Str::limit(strip_tags($a->body), 120) }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- Stats --}}
        <section class="border-b border-gray-200/60 bg-white px-4 py-12">
            <div class="mx-auto max-w-6xl">
                <div class="flex flex-wrap items-center justify-center gap-x-16 gap-y-8 text-center">
                    <div>
                        <p class="font-fraunces text-3xl font-semibold text-[#006837] sm:text-4xl">{{ number_format($stats['students']) }}</p>
                        <p class="mt-1 text-sm text-gray-600">Registered students</p>
                    </div>
                    <div>
                        <p class="font-fraunces text-3xl font-semibold text-[#006837] sm:text-4xl">{{ number_format($stats['lecturers']) }}</p>
                        <p class="mt-1 text-sm text-gray-600">Teaching staff</p>
                    </div>
                    <div>
                        <p class="font-fraunces text-3xl font-semibold text-[#006837] sm:text-4xl">{{ number_format($stats['units']) }}</p>
                        <p class="mt-1 text-sm text-gray-600">Academic units</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Portal features --}}
        <section class="border-b border-gray-200/60 bg-white px-4 py-16 sm:py-20">
            <div class="mx-auto max-w-6xl">
                <h2 class="font-fraunces text-center text-2xl font-semibold text-gray-900 sm:text-3xl">
                    Your academic portal
                </h2>
                <p class="mx-auto mt-2 max-w-xl text-center text-gray-600">
                    One secure platform for unit registration, results, timetables and announcements.
                </p>
                <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="rounded-2xl border border-gray-100 bg-white/90 backdrop-blur p-6 shadow-sm transition hover:border-[#006837]/20 hover:shadow-md">
                        <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#006837]/10 text-[#006837]"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg></span>
                        <h3 class="mt-4 font-fraunces font-semibold text-gray-900">Unit booking</h3>
                        <p class="mt-2 text-sm leading-relaxed text-gray-600">Browse and register for units by semester.</p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-white/90 backdrop-blur p-6 shadow-sm transition hover:border-[#006837]/20 hover:shadow-md">
                        <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#006837]/10 text-[#006837]"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg></span>
                        <h3 class="mt-4 font-fraunces font-semibold text-gray-900">Results & grades</h3>
                        <p class="mt-2 text-sm leading-relaxed text-gray-600">View results and academic progress.</p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-white/90 backdrop-blur p-6 shadow-sm transition hover:border-[#006837]/20 hover:shadow-md">
                        <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#006837]/10 text-[#006837]"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg></span>
                        <h3 class="mt-4 font-fraunces font-semibold text-gray-900">Timetable</h3>
                        <p class="mt-2 text-sm leading-relaxed text-gray-600">Class and exam schedules.</p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-white/90 backdrop-blur p-6 shadow-sm transition hover:border-[#006837]/20 hover:shadow-md">
                        <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#006837]/10 text-[#006837]"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.55.318-1.25.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" /></svg></span>
                        <h3 class="mt-4 font-fraunces font-semibold text-gray-900">Announcements</h3>
                        <p class="mt-2 text-sm leading-relaxed text-gray-600">Official notices and updates.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- For students and staff --}}
        <section class="border-b border-gray-200/60 bg-students px-4 py-16 sm:py-20">
            <div class="mx-auto max-w-6xl">
                <h2 class="font-fraunces text-center text-2xl font-semibold text-gray-900 sm:text-3xl">
                    For students and staff
                </h2>
                <div class="mt-12 grid gap-8 lg:grid-cols-2">
                    <div class="rounded-2xl border border-gray-200/80 bg-white p-8 shadow-sm">
                        <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-800">Students</span>
                        <h3 class="mt-4 font-fraunces text-xl font-semibold text-gray-900">Student portal</h3>
                        <p class="mt-2 leading-relaxed text-gray-600">Access your dashboard to enroll in units, view results, timetables, materials and announcements.</p>
                        @guest
                            <a href="{{ route('register') }}" class="mt-5 inline-flex items-center text-sm font-semibold text-[#006837] hover:underline">Create account →</a>
                        @endguest
                    </div>
                    <div class="rounded-2xl border border-gray-200/80 bg-white p-8 shadow-sm">
                        <span class="inline-flex items-center rounded-full bg-amber-100 px-3 py-1 text-xs font-medium text-amber-800">Staff</span>
                        <h3 class="mt-4 font-fraunces text-xl font-semibold text-gray-900">Lecturer portal</h3>
                        <p class="mt-2 leading-relaxed text-gray-600">Manage units, students, grades, materials and announcements from your dedicated portal.</p>
                        @guest
                            <a href="{{ route('login') }}" class="mt-5 inline-flex items-center text-sm font-semibold text-[#006837] hover:underline">Log in →</a>
                        @endguest
                    </div>
                </div>
            </div>
        </section>

        {{-- Contact --}}
        <section id="contact" class="border-b border-gray-200/60 bg-white px-4 py-16 sm:py-20">
            <div class="mx-auto max-w-6xl">
                <h2 class="font-fraunces text-center text-2xl font-semibold text-gray-900 sm:text-3xl">
                    Contact us
                </h2>
                <p class="mx-auto mt-2 max-w-xl text-center text-gray-600">
                    Get in touch with {{ $school['name'] }}.
                </p>
                <div class="mt-12 grid gap-8 sm:grid-cols-3 text-center">
                    <div class="rounded-2xl border border-gray-100 bg-white/90 backdrop-blur p-6 shadow-sm">
                        <span class="flex h-12 w-12 mx-auto items-center justify-center rounded-xl bg-[#006837]/10 text-[#006837]"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg></span>
                        <h3 class="mt-4 font-fraunces font-semibold text-gray-900">Visit</h3>
                        <p class="mt-2 text-sm text-gray-600">{{ $school['address'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-white/90 backdrop-blur p-6 shadow-sm">
                        <span class="flex h-12 w-12 mx-auto items-center justify-center rounded-xl bg-[#006837]/10 text-[#006837]"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg></span>
                        <h3 class="mt-4 font-fraunces font-semibold text-gray-900">Call</h3>
                        <a href="tel:{{ $school['phone'] }}" class="mt-2 block text-sm text-gray-600 hover:text-[#006837]">{{ $school['phone'] }}</a>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-white/90 backdrop-blur p-6 shadow-sm">
                        <span class="flex h-12 w-12 mx-auto items-center justify-center rounded-xl bg-[#006837]/10 text-[#006837]"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg></span>
                        <h3 class="mt-4 font-fraunces font-semibold text-gray-900">Email</h3>
                        <a href="mailto:{{ $school['email'] }}" class="mt-2 block text-sm text-gray-600 hover:text-[#006837]">{{ $school['email'] }}</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Intakes CTA banner (Sigalagala style) --}}
        <section class="border-b border-gray-200/60 bg-[#006837] px-4 py-12 sm:py-16">
            <div class="mx-auto max-w-6xl text-center">
                <h2 class="font-fraunces text-3xl font-semibold text-white sm:text-4xl lg:text-5xl">
                    Intakes Ongoing — Applications Invited
                </h2>
                <p class="mx-auto mt-4 max-w-2xl text-lg text-white/90">
                    Join {{ $school['name'] }} for quality education and career advancement.
                </p>
                <a href="{{ route('public.admissions') }}" class="mt-8 inline-flex items-center rounded-xl bg-white px-8 py-4 text-base font-semibold text-[#006837] shadow-lg transition hover:bg-gray-100">
                    Apply Today
                </a>
            </div>
        </section>

        {{-- CTA for portal --}}
        @guest
        <section class="px-4 py-12 sm:py-16">
            <div class="mx-auto max-w-3xl rounded-3xl border-2 border-[#006837]/20 bg-white px-6 py-12 text-center sm:px-12 sm:py-16">
                <h2 class="font-fraunces text-2xl font-semibold text-gray-900 sm:text-3xl">
                    Already applied? Access your portal
                </h2>
                <p class="mt-3 text-gray-600">
                    Log in to manage your units, view results and stay updated.
                </p>
                <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center rounded-xl bg-[#006837] px-6 py-3.5 text-base font-semibold text-white shadow-lg transition hover:bg-[#005a2e]">
                        Register now
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center rounded-xl border-2 border-[#006837] px-6 py-3.5 text-base font-semibold text-[#006837] transition hover:bg-[#006837]/5">
                        Log in
                    </a>
                </div>
            </div>
        </section>
        @endguest
    </main>

    {{-- Multi-column footer (Sigalagala style) --}}
    <footer class="border-t border-gray-200 bg-[#006837] px-4 py-14 text-white">
        <div class="mx-auto max-w-6xl">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-5">
                <div class="lg:col-span-2">
                    <h3 class="font-fraunces text-lg font-semibold">{{ $school['name'] }}</h3>
                    <p class="mt-2 text-sm text-white/80">{{ $school['tagline'] }}</p>
                    <p class="mt-3 text-sm text-white/70">{{ $school['address'] }}</p>
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
                        <li><a href="{{ route('public.programs') }}" class="text-white/80 hover:text-white">Academic Programmes</a></li>
                        @guest
                        <li><a href="{{ route('register') }}" class="text-white/80 hover:text-white">Online Application</a></li>
                        @endguest
                    </ul>
                </div>
                <div>
                    <h3 class="font-fraunces text-sm font-semibold uppercase tracking-wider">Info</h3>
                    <ul class="mt-3 space-y-2 text-sm">
                        <li><a href="{{ route('public.news') }}" class="text-white/80 hover:text-white">News & Updates</a></li>
                        <li><a href="{{ route('public.contact') }}" class="text-white/80 hover:text-white">Contact</a></li>
                        <li><a href="{{ route('public.faq') }}" class="text-white/80 hover:text-white">FAQ</a></li>
                        <li><a href="{{ route('login') }}" class="text-white/80 hover:text-white">Staff / Student Portal</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-white/20 pt-8 sm:flex-row">
                <p class="text-sm text-white/70">© {{ date('Y') }} {{ $school['name'] }}. All rights reserved.</p>
                <div class="flex flex-wrap justify-center gap-4 text-sm">
                    <a href="{{ route('public.about') }}" class="text-white/70 hover:text-white">About</a>
                    <a href="{{ route('public.programs') }}" class="text-white/70 hover:text-white">Programs</a>
                    <a href="{{ route('public.admissions') }}" class="text-white/70 hover:text-white">Admissions</a>
                    <a href="{{ route('public.contact') }}" class="text-white/70 hover:text-white">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    @if(request('account_deleted'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.Swal) {
            window.Swal.fire({ icon: 'success', title: 'Account deleted', text: 'Your account has been permanently deleted.' });
            if (window.history && window.history.replaceState) window.history.replaceState({}, '', window.location.pathname);
        }
    });
    </script>
    @endif
</body>
</html>
