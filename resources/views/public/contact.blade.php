@extends('layouts.public')

@section('title', 'Contact — ' . $school['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
    <h1 class="font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">Contact us</h1>
    <p class="mt-2 text-lg text-gray-600">Get in touch with {{ $school['name'] }}</p>

    @if(session('success'))
    <div class="mt-6 rounded-xl border border-primary/20 bg-primary/5 p-5 text-primary-dark">
        <p class="font-medium">{{ session('success') }}</p>
        <p class="mt-1 text-sm opacity-90">We aim to respond within 1–2 working days.</p>
    </div>
    @endif

    <div class="mt-12 grid gap-8 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-1">
            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                <h3 class="font-fraunces font-semibold text-gray-900">Visit</h3>
                <p class="mt-2 text-gray-600">{{ $school['address'] }}</p>
            </div>
            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                <h3 class="font-fraunces font-semibold text-gray-900">Call</h3>
                <a href="tel:{{ $school['phone'] }}" class="mt-2 block text-[#006837] hover:underline">{{ $school['phone'] }}</a>
            </div>
            <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
                <h3 class="font-fraunces font-semibold text-gray-900">Email</h3>
                <a href="mailto:{{ $school['email'] }}" class="mt-2 block text-[#006837] hover:underline">{{ $school['email'] }}</a>
            </div>
            @if(!empty($school['map_embed']))
            <div class="rounded-2xl overflow-hidden border border-gray-100 bg-gray-100 aspect-video">
                {!! $school['map_embed'] !!}
            </div>
            @else
            <div class="rounded-2xl overflow-hidden border border-gray-200 aspect-video bg-gray-100 flex items-center justify-center">
                <div class="text-center p-6">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <p class="mt-2 text-sm text-gray-500">{{ $school['address'] }}</p>
                    <a href="https://maps.google.com/?q={{ urlencode($school['address']) }}" target="_blank" rel="noopener" class="mt-2 inline-flex text-sm font-medium text-[#006837] hover:underline">View on map →</a>
                </div>
            </div>
            @endif
        </div>

        <div class="lg:col-span-2">
            <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-sm">
                <h2 class="font-fraunces text-xl font-semibold text-gray-900">Send a message</h2>
                <form action="{{ route('public.contact.submit') }}" method="post" class="mt-6 space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                        @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                        @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                        @error('subject')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea name="message" id="message" rows="5" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-2 focus:ring-primary focus:ring-opacity-50">{{ old('message') }}</textarea>
                        @error('message')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="focus-ring min-h-[44px] rounded-xl bg-primary px-6 py-3 font-semibold text-white shadow-sm hover:bg-primary-dark">
                        Send message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
