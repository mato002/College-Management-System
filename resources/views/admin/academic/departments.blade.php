<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Departments</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-600 mb-4">Departments (derived from lecturer records).</p>
                <ul class="space-y-2">
                    @forelse($departments as $d)
                        <li class="text-gray-700">{{ $d }}</li>
                    @empty
                        <li class="text-gray-500">No departments found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
