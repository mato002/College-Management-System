<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page not found — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 font-sans antialiased text-gray-900 flex items-center justify-center px-4">
    <div class="w-full max-w-md text-center">
        <p class="text-6xl font-bold text-primary">404</p>
        <h1 class="mt-4 text-2xl font-semibold">Page not found</h1>
        <p class="mt-2 text-gray-600">The page you're looking for doesn't exist or has been moved.</p>
        <a href="{{ url('/') }}" class="focus-ring mt-8 inline-flex min-h-[44px] items-center rounded-xl bg-primary px-6 py-3 font-semibold text-white shadow-sm hover:bg-primary-dark">
            Back to home
        </a>
    </div>
</body>
</html>
