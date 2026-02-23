<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Timetable Management</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Day</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Start</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">End</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Room</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Semester</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($slots as $slot)
                            <tr>
                                <td class="px-4 py-2">{{ $slot->unit->code ?? '—' }} {{ $slot->unit->name ?? '' }}</td>
                                <td class="px-4 py-2">{{ $slot->day_of_week }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($slot->start_time)->format('H:i') }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($slot->end_time)->format('H:i') }}</td>
                                <td class="px-4 py-2">{{ $slot->room ?? '—' }}</td>
                                <td class="px-4 py-2">{{ $slot->semester ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-4 text-gray-500">No timetable slots.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
