@extends('layouts.public')

@section('title', 'Courses & Units — ' . $school['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
    <h1 class="font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">Courses & units</h1>
    <p class="mt-2 text-lg text-gray-600">Browse all academic units and courses offered at {{ $school['name'] }}</p>

    <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($units as $unit)
        <a href="{{ route('public.courses.show', $unit) }}" class="block rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:border-[#006837]/20 hover:shadow-md">
            <span class="text-sm font-medium text-gray-500">{{ $unit->code }}</span>
            <h2 class="mt-2 font-fraunces text-xl font-semibold text-gray-900">{{ $unit->name }}</h2>
            <p class="mt-2 text-gray-600">{{ Str::limit($unit->description, 100) }}</p>
            <div class="mt-4 flex flex-wrap gap-2">
                <span class="rounded-full bg-[#006837]/10 px-3 py-1 text-xs font-medium text-[#006837]">{{ $unit->credits }} credits</span>
                @if($unit->semester)
                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs text-gray-600">{{ $unit->semester }}</span>
                @endif
            </div>
        </a>
        @empty
        <div class="col-span-full">
            <x-empty-state title="No courses yet" message="Course listings will appear here when they are published." icon="document">
                <a href="{{ route('public.programs') }}" class="focus-ring mt-6 inline-flex min-h-[44px] items-center rounded-xl bg-primary px-6 py-3 font-semibold text-white shadow-sm hover:bg-primary-dark">View programmes</a>
            </x-empty-state>
        </div>
        @endforelse
    </div>

    <div class="mt-12 text-center">
        <a href="{{ route('public.programs') }}" class="inline-flex rounded-xl bg-[#006837] px-6 py-3 font-semibold text-white shadow-sm hover:bg-[#005a2e]">View programmes</a>
    </div>
</div>
@endsection
