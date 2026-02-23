@extends('layouts.public')

@section('title', 'Admissions — ' . $school['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
    <h1 class="font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">Admissions</h1>
    <p class="mt-2 text-lg text-gray-600">Join {{ $school['name'] }}</p>

    <div class="mt-12 space-y-12">
        <section class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
            <h2 class="font-fraunces text-xl font-semibold text-[#006837]">Application process</h2>
            <ol class="mt-4 space-y-3">
                @foreach($admissions['process'] ?? [] as $i => $step)
                <li class="flex gap-3">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#006837] text-sm font-bold text-white">{{ $i + 1 }}</span>
                    <span class="text-gray-700">{{ $step }}</span>
                </li>
                @endforeach
            </ol>
        </section>

        <section class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
            <h2 class="font-fraunces text-xl font-semibold text-[#006837]">Requirements</h2>
            <p class="mt-3 leading-relaxed text-gray-600">{{ $admissions['requirements'] ?? 'Contact admissions for details.' }}</p>
        </section>

        @if(!empty($admissions['fees']))
        <section class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
            <h2 class="font-fraunces text-xl font-semibold text-[#006837]">Fees structure</h2>
            <dl class="mt-4 space-y-2">
                @foreach($admissions['fees'] as $label => $amount)
                <div class="flex justify-between">
                    <dt class="text-gray-600">{{ str_replace('_', ' ', ucfirst($label)) }}</dt>
                    <dd class="font-medium text-gray-900">{{ $amount }}</dd>
                </div>
                @endforeach
            </dl>
        </section>
        @endif

        @if(!empty($admissions['intake_dates']))
        <section class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
            <h2 class="font-fraunces text-xl font-semibold text-[#006837]">Intake dates</h2>
            <p class="mt-3 text-gray-700">{{ implode(', ', $admissions['intake_dates']) }}</p>
        </section>
        @endif
    </div>

    <div class="mt-12 rounded-2xl bg-[#006837] p-8 text-center sm:p-12">
        <h2 class="font-fraunces text-2xl font-semibold text-white">Ready to apply?</h2>
        <p class="mt-2 text-[#b8d4e8]">Create your account and complete your application online.</p>
        <a href="{{ route('register') }}" class="mt-6 inline-flex rounded-xl bg-white px-6 py-3.5 font-semibold text-[#006837] shadow-lg hover:bg-gray-100">
            Apply now
        </a>
    </div>
</div>
@endsection
