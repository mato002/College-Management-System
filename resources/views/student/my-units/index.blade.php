<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Units') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="mb-4 text-gray-600">View your registered units, details, and schedule. To book or drop units, use <a href="{{ route('student.units.index') }}" class="text-indigo-600 hover:underline">Unit Booking</a>.</p>

            @if($enrollments->count())
                <div class="space-y-4">
                    @foreach($enrollments as $e)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-5">
                            <div class="flex flex-wrap justify-between gap-2">
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $e->unit->code }} — {{ $e->unit->name }}</h3>
                                    @if($e->unit->description)
                                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($e->unit->description, 160) }}</p>
                                    @endif
                                    <p class="text-xs text-gray-500 mt-2">Semester: {{ $e->semester ?? '—' }} · Enrolled {{ $e->enrolled_at?->format('M j, Y') }}</p>
                                </div>
                                <a href="{{ route('student.units.index') }}" class="self-center text-sm text-indigo-600 hover:underline">Drop unit</a>
                            </div>
                            @if($e->unit->relationLoaded('timetableSlots') && $e->unit->timetableSlots->count())
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Unit Schedule</p>
                                    <ul class="text-sm text-gray-700 space-y-1">
                                        @foreach($e->unit->timetableSlots as $slot)
                                            <li>{{ $slot->day_of_week ?? '—' }} {{ $slot->start_time ?? '' }}–{{ $slot->end_time ?? '' }} @if($slot->room) ({{ $slot->room }}) @endif</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-8 text-center">
                    <p class="text-gray-500">You have no registered units.</p>
                    <a href="{{ route('student.units.index') }}" class="inline-block mt-3 rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Book units</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
