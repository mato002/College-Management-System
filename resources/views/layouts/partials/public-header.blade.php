{{-- Sigalagala-style header: green top bar, white nav, mega-menu --}}
@php
    $school = $school ?? ['name' => config('app.name'), 'tagline' => config('school.tagline'), 'email' => config('school.email'), 'phone' => config('school.phone')];
    $academicDepts = config('school.academic_departments', []);
    $adminDepts = config('school.administrative_departments', []);
    $social = config('school.social', []);
@endphp
<div class="public-header" x-data="{ openDept: false, openAbout: false, openAdmissions: false, openInfo: false, mobileMenu: false }" @click.away="openDept = false; openAbout = false; openAdmissions = false; openInfo = false">
    {{-- Top green bar: social left, contact right --}}
    <div class="bg-[#006837] text-white text-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-2 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4">
                @if(!empty($social['facebook']))<a href="{{ $social['facebook'] }}" target="_blank" rel="noopener noreferrer" class="focus-ring rounded hover:text-white/90" aria-label="Facebook"><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>@endif
                @if(!empty($social['twitter']))<a href="{{ $social['twitter'] }}" target="_blank" rel="noopener noreferrer" class="focus-ring rounded hover:text-white/90" aria-label="Twitter"><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>@endif
                @if(!empty($social['instagram']))<a href="{{ $social['instagram'] }}" target="_blank" rel="noopener noreferrer" class="focus-ring rounded hover:text-white/90" aria-label="Instagram"><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>@endif
                @if(!empty($social['whatsapp']))<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $social['whatsapp']) }}" target="_blank" rel="noopener noreferrer" class="focus-ring rounded hover:text-white/90" aria-label="WhatsApp"><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></a>@endif
            </div>
            <div class="flex items-center gap-4">
                <a href="tel:{{ $school['phone'] ?? config('school.phone') }}" class="flex items-center gap-1.5 hover:text-white/90">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span class="hidden sm:inline">{{ $school['phone'] ?? config('school.phone') }}</span>
                </a>
                <a href="mailto:{{ $school['email'] ?? config('school.email') }}" class="flex items-center gap-1.5 hover:text-white/90">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span class="hidden sm:inline">{{ $school['email'] ?? config('school.email') }}</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Main white nav bar --}}
    <header class="sticky top-0 z-50 border-b border-gray-200 bg-white shadow-sm">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center rounded-full bg-[#006837] text-lg font-bold text-white">C</span>
                <div>
                    <span class="block font-fraunces text-lg font-semibold text-[#006837] leading-tight">{{ $school['name'] ?? config('app.name') }}</span>
                    <span class="hidden text-xs text-gray-500 sm:block">{{ $school['tagline'] ?? config('school.tagline') }}</span>
                </div>
            </a>

            <nav class="hidden items-center gap-1 lg:flex">
                <a href="{{ url('/') }}" class="rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('landing') ? 'text-[#006837] font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">Home</a>

                {{-- About dropdown --}}
                <div class="relative">
                    <button @click="openAbout = !openAbout; openDept = false; openAdmissions = false; openInfo = false" class="flex items-center gap-1 rounded-lg px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                        About
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openAbout" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                         class="absolute left-0 top-full z-50 mt-1 w-48 rounded-lg border border-gray-200 bg-white py-2 shadow-lg" style="display: none;">
                        <a href="{{ route('public.about') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">History & Profile</a>
                        <a href="{{ route('public.departments') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Our Departments</a>
                        <a href="{{ route('public.programs') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Programmes</a>
                    </div>
                </div>

                {{-- Departments mega-menu --}}
                <div class="relative">
                    <button @click="openDept = !openDept; openAbout = false; openAdmissions = false; openInfo = false" class="flex items-center gap-1 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('public.departments') ? 'text-[#006837] font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        Departments
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openDept" x-transition @click.away="openDept = false"
                         class="absolute left-0 top-full z-50 mt-1 min-w-[420px] rounded-lg border border-gray-200 bg-[#fafbfc] p-6 shadow-xl" style="display: none;">
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <h3 class="mb-3 text-xs font-bold uppercase tracking-wider text-gray-500">Academic Departments</h3>
                                <ul class="space-y-2">
                                    @foreach($academicDepts as $d)
                                    <li>
                                        <a href="{{ route('public.departments') }}#{{ $d['slug'] ?? '' }}" class="flex items-center gap-2 text-sm text-gray-700 hover:text-[#006837]">
                                            @switch($d['icon'] ?? '')
                                                @case('leaf')<svg class="h-4 w-4 shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>@break
                                                @case('beaker')<svg class="h-4 w-4 shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>@break
                                                @case('building')<svg class="h-4 w-4 shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>@break
                                                @case('briefcase')<svg class="h-4 w-4 shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>@break
                                                @case('monitor')<svg class="h-4 w-4 shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>@break
                                                @case('chip')<svg class="h-4 w-4 shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>@break
                                                @case('heart')<svg class="h-4 w-4 shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>@break
                                                @case('academic-cap')<svg class="h-4 w-4 shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>@break
                                                @case('cog')<svg class="h-4 w-4 shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>@break
                                                @default<svg class="h-4 w-4 shrink-0 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                            @endswitch
                                            {{ $d['name'] }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div>
                                <h3 class="mb-3 text-xs font-bold uppercase tracking-wider text-gray-500">Administrative Departments</h3>
                                <ul class="space-y-2">
                                    @foreach($adminDepts as $d)
                                    <li>
                                        <a href="{{ route('public.departments') }}#{{ $d['slug'] ?? '' }}" class="flex items-center gap-2 text-sm text-gray-700 hover:text-[#006837]">
                                            <svg class="h-4 w-4 shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                            {{ $d['name'] }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Admissions dropdown --}}
                <div class="relative">
                    <button @click="openAdmissions = !openAdmissions; openDept = false; openAbout = false; openInfo = false" class="flex items-center gap-1 rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('public.admissions') ? 'text-[#006837] font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        Admissions
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openAdmissions" x-transition class="absolute left-0 top-full z-50 mt-1 w-48 rounded-lg border border-gray-200 bg-white py-2 shadow-lg" style="display: none;">
                        <a href="{{ route('public.admissions') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">How To Apply</a>
                        <a href="{{ route('public.programs') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Programmes</a>
                <a href="{{ route('public.courses') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Courses</a>
                        @guest
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Online Application</a>
                        @endguest
                    </div>
                </div>

                {{-- Info dropdown --}}
                <div class="relative">
                    <button @click="openInfo = !openInfo; openDept = false; openAbout = false; openAdmissions = false" class="flex items-center gap-1 rounded-lg px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                        Info
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="openInfo" x-transition class="absolute left-0 top-full z-50 mt-1 w-48 rounded-lg border border-gray-200 bg-white py-2 shadow-lg" style="display: none;">
                        <a href="{{ route('public.news') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">News & Updates</a>
                        <a href="{{ route('public.staff') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Staff</a>
                        <a href="{{ route('public.events') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Events</a>
                        <a href="{{ route('public.faq') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">FAQ</a>
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Portal</a>
                    </div>
                </div>

                <a href="{{ route('public.contact') }}" class="rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('public.contact') ? 'text-[#006837] font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">Contact Us</a>
            </nav>

            <div class="flex items-center gap-2">
                <button type="button" class="hidden rounded-lg px-3 py-2 text-gray-600 hover:bg-gray-50 sm:inline-block" aria-label="Search"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></button>
                <button @click="mobileMenu = !mobileMenu" class="rounded-lg p-2 text-gray-600 hover:bg-gray-100 lg:hidden" aria-label="Menu">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                @auth
                    <a href="{{ url('/dashboard') }}" class="rounded-lg bg-[#006837] px-4 py-2 text-sm font-medium text-white hover:bg-[#005a2e]">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hidden rounded-lg px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 sm:inline-block">Log in</a>
                    @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="rounded-lg bg-[#006837] px-4 py-2 text-sm font-medium text-white hover:bg-[#005a2e]">Register</a>
                    @endif
                @endauth
            </div>
        </div>

        {{-- Mobile menu (touch-friendly min height) --}}
        <div x-show="mobileMenu" x-transition class="border-t border-gray-200 bg-white lg:hidden" style="display: none;">
            <div class="space-y-1 px-4 py-4">
                <a href="{{ url('/') }}" class="focus-ring flex min-h-[44px] items-center rounded-lg px-4 py-3 text-gray-700 hover:bg-gray-50">Home</a>
                <a href="{{ route('public.about') }}" class="focus-ring flex min-h-[44px] items-center rounded-lg px-4 py-3 text-gray-700 hover:bg-gray-50">About</a>
                <a href="{{ route('public.departments') }}" class="focus-ring flex min-h-[44px] items-center rounded-lg px-4 py-3 text-gray-700 hover:bg-gray-50">Departments</a>
                <a href="{{ route('public.programs') }}" class="focus-ring flex min-h-[44px] items-center rounded-lg px-4 py-3 text-gray-700 hover:bg-gray-50">Programmes</a>
                <a href="{{ route('public.courses') }}" class="focus-ring flex min-h-[44px] items-center rounded-lg px-4 py-3 text-gray-700 hover:bg-gray-50">Courses</a>
                <a href="{{ route('public.admissions') }}" class="focus-ring flex min-h-[44px] items-center rounded-lg px-4 py-3 text-gray-700 hover:bg-gray-50">Admissions</a>
                <a href="{{ route('public.news') }}" class="focus-ring flex min-h-[44px] items-center rounded-lg px-4 py-3 text-gray-700 hover:bg-gray-50">News</a>
                <a href="{{ route('public.staff') }}" class="focus-ring flex min-h-[44px] items-center rounded-lg px-4 py-3 text-gray-700 hover:bg-gray-50">Staff</a>
                <a href="{{ route('public.events') }}" class="focus-ring flex min-h-[44px] items-center rounded-lg px-4 py-3 text-gray-700 hover:bg-gray-50">Events</a>
                <a href="{{ route('public.contact') }}" class="focus-ring flex min-h-[44px] items-center rounded-lg px-4 py-3 text-gray-700 hover:bg-gray-50">Contact Us</a>
            </div>
        </div>
    </header>
</div>
