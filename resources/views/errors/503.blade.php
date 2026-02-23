<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maintenance — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 font-sans antialiased text-gray-900 flex items-center justify-center px-4">
    <div class="w-full max-w-md text-center">
        <p class="text-5xl">🔧</p>
        <h1 class="mt-4 text-2xl font-semibold">Under maintenance</h1>
        <p class="mt-2 text-gray-600">We're making improvements. Please try again in a few minutes.</p>
        <a href="{{ url('/') }}" class="focus-ring mt-8 inline-flex min-h-[44px] items-center rounded-xl bg-primary px-6 py-3 font-semibold text-white shadow-sm hover:bg-primary-dark">
            Try again
        </a>
    </div>
</body>
</html>
