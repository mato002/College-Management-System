@extends('layouts.public')

@section('title', 'About Us — ' . $school['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
    <h1 class="font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">About {{ $school['name'] }}</h1>
    <p class="mt-2 text-lg text-gray-600">{{ $school['tagline'] }}</p>

    <div class="mt-12 space-y-12">
        <section>
            <h2 class="font-fraunces text-xl font-semibold text-[#1e3a5f]">Our history</h2>
            <p class="mt-3 leading-relaxed text-gray-600">{{ $school['history'] }}</p>
        </section>

        <section id="vision-mission" class="grid gap-8 lg:grid-cols-2">
            <div id="mission" class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
                <h2 class="font-fraunces text-xl font-semibold text-[#1e3a5f]">Mission</h2>
                <p class="mt-3 leading-relaxed text-gray-600">{{ $school['mission'] }}</p>
            </div>
            <div id="vision" class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
                <h2 class="font-fraunces text-xl font-semibold text-[#1e3a5f]">Vision</h2>
                <p class="mt-3 leading-relaxed text-gray-600">{{ $school['vision'] }}</p>
            </div>
        </section>

        @if(!empty($school['leadership']))
        <section>
            <h2 class="font-fraunces text-xl font-semibold text-[#1e3a5f]">Leadership</h2>
            <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($school['leadership'] as $leader)
                <div class="rounded-xl border border-gray-100 bg-white p-6">
                    <p class="font-semibold text-gray-900">{{ $leader['name'] }}</p>
                    <p class="text-sm text-[#1e3a5f] font-medium">{{ $leader['role'] }}</p>
                    <p class="text-sm text-gray-500">{{ $leader['department'] }}</p>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        @if(!empty($school['departments']))
        <section>
            <h2 class="font-fraunces text-xl font-semibold text-[#1e3a5f]">Departments</h2>
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach($school['departments'] as $dept)
                <span class="rounded-full bg-[#1e3a5f]/10 px-4 py-2 text-sm font-medium text-[#1e3a5f]">{{ $dept }}</span>
                @endforeach
            </div>
        </section>
        @endif

        @if(!empty($school['facilities']))
        <section>
            <h2 class="font-fraunces text-xl font-semibold text-[#1e3a5f]">Facilities</h2>
            <ul class="mt-4 grid gap-3 sm:grid-cols-2">
                @foreach($school['facilities'] as $facility)
                <li class="flex items-center gap-2 text-gray-700">
                    <svg class="h-5 w-5 shrink-0 text-[#1e3a5f]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ $facility }}
                </li>
                @endforeach
            </ul>
        </section>
        @endif
    </div>

    <div class="mt-12 text-center">
        <a href="{{ route('public.admissions') }}" class="inline-flex rounded-xl bg-[#1e3a5f] px-6 py-3 font-semibold text-white shadow-sm hover:bg-[#005a2e]">Apply now</a>
    </div>
</div>
@endsection
