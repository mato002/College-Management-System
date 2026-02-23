<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lecturer Reports</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-900 mb-4">Overview</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $total }} total lecturers</p>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-900 mb-4">By Department</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50"><tr><th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Department</th><th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Count</th></tr></thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($byDepartment as $row)
                            <tr><td class="px-4 py-2">{{ $row->department ?? 'Unassigned' }}</td><td class="px-4 py-2 text-right">{{ $row->total }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
