@extends('layouts.public')

@section('title', 'News & Announcements — ' . $school['name'])

@section('content')
<div class="mx-auto max-w-6xl px-4 py-16 sm:py-20">
    <h1 class="font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">News & announcements</h1>
    <p class="mt-2 text-lg text-gray-600">Latest updates from {{ $school['name'] }}</p>

    <div class="mt-12 space-y-6">
        @forelse($announcements as $a)
        <a href="{{ route('public.news.show', $a) }}" class="block rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition hover:border-[#006837]/20 hover:shadow-md">
            <h2 class="font-fraunces text-xl font-semibold text-gray-900">{{ $a->title }}</h2>
            <p class="mt-2 text-sm text-gray-500">By {{ $a->user->name ?? '—' }} · {{ $a->created_at->format('d M Y') }}</p>
            <p class="mt-3 text-gray-600">{{ Str::limit(strip_tags($a->body), 200) }}</p>
            <span class="mt-3 inline-flex text-sm font-semibold text-[#006837]">Read more →</span>
        </a>
        @empty
        <x-empty-state title="No news yet" message="Announcements and updates will appear here." icon="newspaper" />
        @endforelse
    </div>

    <div class="mt-8">{{ $announcements->links() }}</div>
</div>
@endsection
