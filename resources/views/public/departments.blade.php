@extends('layouts.public')

@section('title', 'Departments — ' . $school['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
    <h1 class="font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">Our departments</h1>
    <p class="mt-2 text-lg text-gray-600">Academic and administrative departments at {{ $school['name'] }}</p>

    @if(!empty($academic))
    <section class="mt-12">
        <h2 class="mb-6 text-sm font-bold uppercase tracking-wider text-gray-500">Academic Departments</h2>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($academic as $dept)
            <a href="{{ route('public.departments.show', $dept['slug'] ?? '') }}" id="{{ $dept['slug'] ?? '' }}" class="scroll-mt-24 block rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:border-[#006837]/20 hover:shadow-md">
                <h3 class="font-fraunces text-lg font-semibold text-[#006837]">{{ $dept['name'] ?? '' }}</h3>
                <p class="mt-2 text-sm text-gray-600">{{ Str::limit($dept['description'] ?? 'View details', 80) }}</p>
                <span class="mt-3 inline-flex text-sm font-medium text-[#006837]">View details →</span>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    @if(!empty($administrative))
    <section class="mt-12">
        <h2 class="mb-6 text-sm font-bold uppercase tracking-wider text-gray-500">Administrative Departments</h2>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($administrative as $dept)
            <a href="{{ route('public.departments.show', $dept['slug'] ?? '') }}" id="{{ $dept['slug'] ?? '' }}" class="scroll-mt-24 block rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:border-[#006837]/20 hover:shadow-md">
                <h3 class="font-fraunces text-lg font-semibold text-[#006837]">{{ $dept['name'] ?? '' }}</h3>
                <p class="mt-2 text-sm text-gray-600">{{ Str::limit($dept['description'] ?? 'View details', 80) }}</p>
                <span class="mt-3 inline-flex text-sm font-medium text-[#006837]">View details →</span>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <div class="mt-12 text-center">
        <a href="{{ route('public.programs') }}" class="inline-flex rounded-xl bg-[#006837] px-6 py-3 font-semibold text-white shadow-sm hover:bg-[#005a2e]">View programmes</a>
    </div>
</div>
@endsection
