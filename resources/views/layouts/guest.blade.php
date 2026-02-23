<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? $heading ?? config('app.name', 'School Management') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50 flex flex-col">
    <div class="flex min-h-screen flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="{{ url('/') }}" class="flex flex-col items-center gap-2">
                <span class="flex h-14 w-14 items-center justify-center rounded-xl bg-indigo-600 text-2xl font-semibold text-white">C</span>
                <span class="text-center text-base font-semibold text-gray-800">{{ config('app.name') }}</span>
            </a>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white/95 backdrop-blur px-6 py-10 shadow-xl ring-1 ring-gray-200/50 sm:rounded-2xl sm:px-10">
                @if(isset($heading))
                    <h2 class="text-center text-2xl font-semibold tracking-tight text-gray-900">
                        {{ $heading }}
                    </h2>
                    <p class="mt-1 text-center text-sm text-gray-500">{{ $headingSub ?? '' }}</p>
                    <div class="mt-8">{{ $slot }}</div>
                @else
                    {{ $slot }}
                @endif
            </div>
            @if(isset($footer))
                <p class="mt-6 text-center text-sm text-gray-600">
                    {!! $footer !!}
                </p>
            @endif
        </div>
    </div>
</body>
</html>
