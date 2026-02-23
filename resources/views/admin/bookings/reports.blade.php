<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Unit Registration Reports</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-900 mb-4">Enrollment by Unit</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Semester</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Count</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($byUnitRaw as $row)
                                <tr>
                                    <td class="px-4 py-2">{{ $units->get($row->unit_id)?->code ?? '—' }} {{ $units->get($row->unit_id)?->name ?? '' }}</td>
                                    <td class="px-4 py-2">{{ $row->semester ?? '—' }}</td>
                                    <td class="px-4 py-2">{{ $row->status }}</td>
                                    <td class="px-4 py-2 text-right">{{ $row->total }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-4 py-4 text-gray-500">No data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-900 mb-4">Enrollment by Semester</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Semester</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Count</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse(collect($bySemester)->flatten() as $row)
                                <tr>
                                    <td class="px-4 py-2">{{ $row->semester ?? '—' }}</td>
                                    <td class="px-4 py-2">{{ $row->status }}</td>
                                    <td class="px-4 py-2 text-right">{{ $row->total }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="px-4 py-4 text-gray-500">No data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
