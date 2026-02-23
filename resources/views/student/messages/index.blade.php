<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="mb-4 text-gray-600">Contact lecturers and send support requests. Notifications will appear here.</p>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-8 text-center">
                <p class="text-gray-500">Messaging is optional. Contact your lecturer via college email or office hours. Support requests can be added in a future update.</p>
            </div>
        </div>
    </div>
</x-app-layout>
