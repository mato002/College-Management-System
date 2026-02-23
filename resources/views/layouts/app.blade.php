<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'College Management System') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-100" x-data="{ sidebarOpen: false, sidebarCollapsed: false }" x-init="sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true'" @sidebar-collapsed.window="sidebarCollapsed = $event.detail">
        <div class="flex min-h-screen">
            {{-- Sidebar: full height, collapsible on desktop --}}
            @include('layouts.partials.sidebar')

            {{-- Main area: offset by sidebar width (64 or 20 when collapsed) --}}
            <div class="flex flex-1 min-w-0 flex-col transition-[padding] duration-200" :class="sidebarCollapsed ? 'lg:pl-20' : 'lg:pl-64'">
                {{-- Header --}}
                @include('layouts.partials.header')

                {{-- Page heading (optional) --}}
                @isset($header)
                    <div class="bg-white shadow-sm">
                        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </div>
                @endisset

                {{-- Page content --}}
                <main class="flex-1 overflow-auto">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </main>

                {{-- Footer --}}
                @include('layouts.partials.footer')
            </div>
        </div>

        {{-- SweetAlert for flash messages (dashboard) --}}
        @if(session('success'))
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.Swal) window.Swal.fire({ icon: 'success', title: 'Success', text: @json(session('success')) });
        });
        </script>
        @endif
        @if(session('error'))
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.Swal) window.Swal.fire({ icon: 'error', title: 'Error', text: @json(session('error')) });
        });
        </script>
        @endif
        @if(session('status') === 'profile-updated')
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.Swal) window.Swal.fire({ icon: 'success', title: 'Saved', text: 'Profile information updated.' });
        });
        </script>
        @endif
        @if(session('status') === 'password-updated')
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.Swal) window.Swal.fire({ icon: 'success', title: 'Saved', text: 'Your password has been updated.' });
        });
        </script>
        @endif
        @if(session('status') === 'biodata-updated')
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.Swal) window.Swal.fire({ icon: 'success', title: 'Saved', text: 'Your biodata has been updated.' });
        });
        </script>
        @endif
        @if(session('status') === 'verification-link-sent')
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.Swal) window.Swal.fire({ icon: 'success', title: 'Verification email sent', text: 'A new verification link has been sent to your email address.' });
        });
        </script>
        @endif
        @if(session('status') === 'sessions-revoked')
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.Swal) window.Swal.fire({ icon: 'success', title: 'Done', text: 'You have been signed out from all other devices.' });
        });
        </script>
        @endif
    </body>
</html>
