@extends('layouts.public')

@section('title', 'Events — ' . $school['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
    <h1 class="font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">Upcoming events</h1>
    <p class="mt-2 text-lg text-gray-600">Seminars, ceremonies and campus activities</p>

    <div class="mt-12 space-y-6">
        @forelse($events as $event)
        <a href="{{ route('public.events.show', $event['slug'] ?? Str::slug($event['title'] ?? 'event')) }}" class="flex flex-col gap-4 rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:border-[#006837]/20 hover:shadow-md sm:flex-row sm:items-center">
            <div class="flex shrink-0 flex-col items-center justify-center rounded-xl bg-[#006837] px-4 py-3 text-center text-white">
                <span class="text-2xl font-bold leading-none">{{ \Carbon\Carbon::parse($event['date'])->format('d') }}</span>
                <span class="text-sm">{{ \Carbon\Carbon::parse($event['date'])->format('M') }}</span>
                <span class="text-xs">{{ \Carbon\Carbon::parse($event['date'])->format('Y') }}</span>
            </div>
            <div class="flex-1">
                <span class="rounded-full bg-[#006837]/10 px-2.5 py-0.5 text-xs font-medium text-[#006837]">{{ $event['type'] ?? 'Event' }}</span>
                <h2 class="mt-2 font-fraunces text-xl font-semibold text-gray-900">{{ $event['title'] }}</h2>
                <p class="mt-1 text-gray-600">{{ Str::limit($event['description'] ?? '', 120) }}</p>
                <span class="mt-2 inline-flex text-sm font-semibold text-[#006837]">View details →</span>
            </div>
        </a>
        @empty
        <x-empty-state title="No upcoming events" message="Events and dates will be posted here when scheduled." icon="calendar">
            <a href="{{ route('public.contact') }}" class="focus-ring mt-6 inline-flex min-h-[44px] items-center rounded-xl bg-primary px-6 py-3 font-semibold text-white shadow-sm hover:bg-primary-dark">Contact us</a>
        </x-empty-state>
        @endforelse
    </div>

    <div class="mt-12 text-center">
        <a href="{{ route('public.contact') }}" class="inline-flex text-[#006837] font-semibold hover:underline">Contact us for event enquiries →</a>
    </div>
</div>
@endsection
