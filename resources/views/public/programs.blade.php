@extends('layouts.public')

@section('title', 'Programs & Courses — ' . $school['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
    <h1 class="font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">Programs & courses</h1>
    <p class="mt-2 text-lg text-gray-600">Explore our academic offerings</p>

    <div class="mt-12 grid gap-6 md:grid-cols-2">
        @foreach($programs as $program)
        @php $detail = $programDetails[$program] ?? ['duration' => '4 years', 'credits' => 120, 'requirements' => 'KCSE C+ or equivalent', 'slug' => Str::slug($program)]; @endphp
        <a href="{{ route('public.programs.show', $detail['slug'] ?? Str::slug($program)) }}" class="block rounded-2xl border border-gray-100 bg-white p-8 shadow-sm transition hover:shadow-md">
            <h2 class="font-fraunces text-xl font-semibold text-gray-900">{{ $program }}</h2>
            <p class="mt-2 text-sm text-gray-600">{{ Str::limit($detail['description'] ?? '', 100) }}</p>
            <dl class="mt-4 space-y-2">
                <div class="flex justify-between text-sm">
                    <dt class="text-gray-500">Duration</dt>
                    <dd class="font-medium text-gray-900">{{ $detail['duration'] ?? '4 years' }}</dd>
                </div>
                <div class="flex justify-between text-sm">
                    <dt class="text-gray-500">Credits</dt>
                    <dd class="font-medium text-gray-900">{{ $detail['credits'] ?? 120 }}</dd>
                </div>
                <div class="text-sm">
                    <dt class="text-gray-500">Requirements</dt>
                    <dd class="mt-1 text-gray-700">{{ $detail['requirements'] ?? 'KCSE C+ or equivalent' }}</dd>
                </div>
            </dl>
            <span class="mt-6 inline-flex text-sm font-semibold text-[#006837]">View details →</span>
        </a>
        @endforeach
    </div>

    <div class="mt-12 flex flex-wrap justify-center gap-4">
        <a href="{{ route('public.courses') }}" class="inline-flex rounded-xl bg-[#006837] px-6 py-3 font-semibold text-white shadow-sm hover:bg-[#005a2e]">Browse courses</a>
        <a href="{{ route('public.admissions') }}" class="inline-flex rounded-xl border-2 border-[#006837] px-6 py-3 font-semibold text-[#006837] hover:bg-[#006837]/5">View admissions</a>
    </div>
</div>
@endsection
