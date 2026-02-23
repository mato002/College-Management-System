<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Unit Enrollment Reports</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 text-xl font-semibold text-gray-900">{{ $totalEnrolled }} total enrollments</div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Unit Code</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Unit Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Capacity</th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Enrolled</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($units as $u)
                            <tr>
                                <td class="px-4 py-2">{{ $u->code }}</td>
                                <td class="px-4 py-2">{{ $u->name }}</td>
                                <td class="px-4 py-2">{{ $u->capacity ?? '—' }}</td>
                                <td class="px-4 py-2 text-right">{{ $u->enrollments_count ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
