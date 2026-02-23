<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">System Usage Stats</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Total Users</div>
                    <div class="text-2xl font-semibold text-gray-900">{{ $stats['users'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Students</div>
                    <div class="text-2xl font-semibold text-gray-900">{{ $stats['students'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Lecturers</div>
                    <div class="text-2xl font-semibold text-gray-900">{{ $stats['lecturers'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Units</div>
                    <div class="text-2xl font-semibold text-gray-900">{{ $stats['units'] }}</div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-500 text-sm">Enrollments</div>
                    <div class="text-2xl font-semibold text-gray-900">{{ $stats['enrollments'] }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
