@extends('layouts.public')

@section('title', $unit->name . ' - ' . $school['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
    <x-breadcrumbs :items="[
        ['label' => 'Courses', 'url' => route('public.courses')],
        ['label' => $unit->code . ' – ' . $unit->name],
    ]" />

    <span class="text-sm font-medium text-gray-500">{{ $unit->code }}</span>
    <h1 class="mt-1 font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">{{ $unit->name }}</h1>

    <div class="mt-6 flex flex-wrap gap-3">
        <span class="rounded-full bg-[#006837]/10 px-4 py-2 text-sm font-medium text-[#006837]">{{ $unit->credits }} credits</span>
        @if($unit->semester)
        <span class="rounded-full bg-gray-100 px-4 py-2 text-sm text-gray-700">{{ $unit->semester }}</span>
        @endif
    </div>

    @if($unit->description)
    <section class="mt-8">
        <h2 class="font-fraunces text-lg font-semibold text-[#006837]">Description</h2>
        <p class="mt-3 leading-relaxed text-gray-700">{{ $unit->description }}</p>
    </section>
    @endif

    @if($unit->lecturers->isNotEmpty())
    <section class="mt-10">
        <h2 class="font-fraunces text-lg font-semibold text-[#006837]">Teaching staff</h2>
        <div class="mt-4 grid gap-4 sm:grid-cols-2">
            @foreach($unit->lecturers as $lec)
            <a href="{{ route('public.staff') }}" class="flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-[#006837]/10 text-lg font-bold text-[#006837]">{{ substr($lec->user->name ?? '?', 0, 1) }}</div>
                <div>
                    <p class="font-semibold text-gray-900">{{ $lec->user->name ?? '—' }}</p>
                    <p class="text-sm text-gray-500">{{ $lec->title ?? $lec->department ?? 'Lecturer' }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <div class="mt-12 flex flex-wrap gap-4">
        <a href="{{ route('public.programs') }}" class="focus-ring inline-flex min-h-[44px] items-center rounded-xl bg-primary px-6 py-3 font-semibold text-white shadow-sm hover:bg-primary-dark">View programmes</a>
        <a href="{{ route('public.admissions') }}" class="focus-ring inline-flex min-h-[44px] items-center rounded-xl border-2 border-primary px-6 py-3 font-semibold text-primary hover:bg-primary/10">Apply now</a>
    </div>
</div>
@endsection
