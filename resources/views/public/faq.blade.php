@extends('layouts.public')

@section('title', 'FAQ — ' . $school['name'])

@section('content')
<div class="mx-auto max-w-4xl px-4 py-16 sm:py-20">
    <h1 class="font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">Frequently asked questions</h1>
    <p class="mt-2 text-lg text-gray-600">Quick answers to common questions</p>

    <div class="mt-12 space-y-4">
        @forelse($faq as $item)
        <details class="group rounded-2xl border border-gray-100 bg-white shadow-sm">
            <summary class="flex cursor-pointer items-center justify-between px-6 py-4 font-semibold text-gray-900 list-none">
                {{ $item['q'] }}
                <span class="ml-2 shrink-0 transition group-open:rotate-180">
                    <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </span>
            </summary>
            <div class="border-t border-gray-100 px-6 py-4 text-gray-600">
                {{ $item['a'] }}
            </div>
        </details>
        @empty
        <div class="rounded-2xl border border-gray-100 bg-white p-12 text-center text-gray-500">
            No FAQ entries yet.
        </div>
        @endforelse
    </div>

    <div class="mt-12 rounded-2xl bg-[#006837]/5 p-8 text-center">
        <p class="text-gray-700">Can't find what you need?</p>
        <a href="{{ route('public.contact') }}" class="mt-3 inline-flex font-semibold text-[#006837] hover:underline">Contact us</a>
    </div>
</div>
@endsection
