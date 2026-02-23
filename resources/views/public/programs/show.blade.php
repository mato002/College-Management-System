@extends('layouts.public')

@section('title', ($details['name'] ?? $programName ?? 'Program') . ' — ' . $school['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
    <x-breadcrumbs :items="[
        ['label' => 'Programmes', 'url' => route('public.programs')],
        ['label' => $details['name'] ?? $programName ?? 'Program'],
    ]" />

    <h1 class="font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">{{ $details['name'] ?? $programName ?? '' }}</h1>
    <p class="mt-4 text-lg text-gray-600">{{ $details['description'] ?? 'Explore this programme at ' . $school['name'] }}</p>

    <dl class="mt-8 grid gap-6 sm:grid-cols-3">
        <div class="rounded-xl border border-gray-100 bg-white p-6">
            <dt class="text-sm font-medium text-gray-500">Duration</dt>
            <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $details['duration'] ?? '4 years' }}</dd>
        </div>
        <div class="rounded-xl border border-gray-100 bg-white p-6">
            <dt class="text-sm font-medium text-gray-500">Credits</dt>
            <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $details['credits'] ?? 120 }}</dd>
        </div>
        <div class="rounded-xl border border-gray-100 bg-white p-6 sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">Requirements</dt>
            <dd class="mt-1 text-gray-900">{{ $details['requirements'] ?? 'KCSE C+ or equivalent' }}</dd>
        </div>
    </dl>

    @if($units->isNotEmpty())
    <section class="mt-12">
        <h2 class="font-fraunces text-xl font-semibold text-[#006837]">Sample units & courses</h2>
        <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($units->take(9) as $u)
            <a href="{{ route('public.courses.show', $u) }}" class="block rounded-xl border border-gray-100 bg-white p-5 shadow-sm transition hover:border-[#006837]/20 hover:shadow-md">
                <span class="text-sm font-medium text-gray-500">{{ $u->code }}</span>
                <h3 class="mt-1 font-semibold text-gray-900">{{ $u->name }}</h3>
                <p class="mt-1 text-sm text-gray-600">{{ Str::limit($u->description, 60) }}</p>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    <div class="mt-12 flex flex-wrap gap-4">
        <a href="{{ route('public.admissions') }}" class="focus-ring inline-flex min-h-[44px] items-center rounded-xl bg-primary px-6 py-3 font-semibold text-white shadow-sm hover:bg-primary-dark">Apply now</a>
        <a href="{{ route('public.courses') }}" class="focus-ring inline-flex min-h-[44px] items-center rounded-xl border-2 border-primary px-6 py-3 font-semibold text-primary hover:bg-primary/10">Browse all courses</a>
    </div>
</div>
@endsection
