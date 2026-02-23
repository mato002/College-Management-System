@extends('layouts.public')

@section('title', $announcement->title . ' — ' . $school['name'])

@section('content')
<div class="mx-auto max-w-3xl px-4 py-16 sm:py-20">
    <x-breadcrumbs :items="[
        ['label' => 'News & Updates', 'url' => route('public.news')],
        ['label' => Str::limit($announcement->title, 50)],
    ]" />

    <article>
        <h1 class="font-fraunces text-3xl font-semibold text-gray-900 sm:text-4xl">{{ $announcement->title }}</h1>
        <p class="mt-3 text-gray-500">By {{ $announcement->user->name ?? '—' }} · {{ $announcement->created_at->format('F d, Y') }}</p>

        <div class="mt-8 prose prose-gray max-w-none">
            {!! nl2br(e($announcement->body)) !!}
        </div>
    </article>

    <div class="mt-12">
        <a href="{{ route('public.news') }}" class="focus-ring inline-flex min-h-[44px] items-center rounded-xl bg-primary px-6 py-3 font-semibold text-white shadow-sm hover:bg-primary-dark">← Back to News</a>
    </div>
</div>
@endsection
