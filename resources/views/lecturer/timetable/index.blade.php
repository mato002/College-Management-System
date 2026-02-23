<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Timetable / Schedule</h2>
    </x-slot>

    <div class="space-y-6">
        <p class="text-sm text-gray-600">Your teaching schedule by unit.</p>

        @if($units->count())
            @foreach($units as $unit)
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="font-semibold text-gray-900">{{ $unit->code }} — {{ $unit->name }}</h3>
                    @if($unit->timetableSlots->count())
                        <ul class="mt-4 space-y-2">
                            @foreach($unit->timetableSlots as $slot)
                                <li class="flex items-center gap-4 rounded-lg border border-gray-100 py-2 px-3 text-sm">
                                    <span class="font-medium text-gray-700">{{ $slot->day_of_week }}</span>
                                    <span class="text-gray-600">{{ $slot->start_time }} – {{ $slot->end_time }}</span>
                                    @if($slot->room)
                                        <span class="text-gray-500">Room: {{ $slot->room }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-4 text-gray-500">No schedule slots set for this unit. Admin can add them.</p>
                    @endif
                </div>
            @endforeach
        @else
            <div class="rounded-xl border border-gray-200 bg-white p-8 text-center text-gray-500">
                No units assigned. Your timetable will appear here when you have assigned units.
            </div>
        @endif
    </div>
</x-app-layout>
