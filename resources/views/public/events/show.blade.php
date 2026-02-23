@extends('layouts.public')

@section('title', ($event['title'] ?? 'Event') . ' — ' . $school['name'])

@section('content')
<div class="mx-auto max-w-3xl px-4 py-16 sm:py-20">
    <x-breadcrumbs :items="[
        ['label' => 'Events', 'url' => route('public.events')],
        ['label' => $event['title'] ?? 'Event'],
    ]" />

    <span class="rounded-full bg-[#006837]/10 px-3 py-1 text-sm font-medium text-[#006837]">{{ $event['type'] ?? 'Event' }}</span>
    <h1 class="mt-4 font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">{{ $event['title'] ?? '' }}</h1>

    <div class="mt-6 flex items-center gap-4 rounded-xl border border-gray-100 bg-white p-6">
        <div class="flex shrink-0 flex-col items-center justify-center rounded-xl bg-[#006837] px-6 py-4 text-center text-white">
            <span class="text-3xl font-bold leading-none">{{ \Carbon\Carbon::parse($event['date'] ?? now())->format('d') }}</span>
            <span class="text-sm">{{ \Carbon\Carbon::parse($event['date'] ?? now())->format('F') }}</span>
            <span class="text-xs">{{ \Carbon\Carbon::parse($event['date'] ?? now())->format('Y') }}</span>
        </div>
        <div>
            <p class="text-lg text-gray-700">{{ $event['description'] ?? '' }}</p>
        </div>
    </div>

    <div class="mt-12">
        <a href="{{ route('public.contact') }}" class="focus-ring inline-flex min-h-[44px] items-center rounded-xl bg-primary px-6 py-3 font-semibold text-white shadow-sm hover:bg-primary-dark">Contact us for enquiries</a>
    </div>
</div>
@endsection
