@extends('layouts.public')

@section('title', 'Staff & Lecturers — ' . $school['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
    <h1 class="font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">Our staff & lecturers</h1>
    <p class="mt-2 text-lg text-gray-600">Meet the dedicated faculty at {{ $school['name'] }}</p>

    <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($lecturers as $lecturer)
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-[#006837]/10 text-2xl font-bold text-[#006837]">
                {{ strtoupper(substr($lecturer->user->name ?? '?', 0, 1)) }}
            </div>
            <h2 class="mt-4 font-fraunces text-lg font-semibold text-gray-900">{{ $lecturer->user->name ?? '—' }}</h2>
            @if($lecturer->title)
            <p class="text-sm text-[#006837] font-medium">{{ $lecturer->title }}</p>
            @endif
            @if($lecturer->department)
            <p class="text-sm text-gray-500">{{ $lecturer->department }}</p>
            @endif
        </div>
        @empty
        <div class="col-span-full rounded-2xl border border-gray-100 bg-white p-12 text-center text-gray-500">
            No staff profiles to display yet.
        </div>
        @endforelse
    </div>
</div>
@endsection
