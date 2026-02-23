<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Timetable / Schedule') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="mb-4 text-gray-600">Your class and exam schedule for registered units.</p>

            @if($enrollments->count())
                <div class="space-y-6">
                    @foreach($enrollments as $e)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-5">
                            <h3 class="font-semibold text-gray-900">{{ $e->unit->code }} — {{ $e->unit->name }}</h3>
                            @if($e->unit->timetableSlots && $e->unit->timetableSlots->count())
                                <ul class="mt-3 space-y-2">
                                    @foreach($e->unit->timetableSlots as $slot)
                                        <li class="text-sm text-gray-700 flex flex-wrap gap-x-4">
                                            <span class="font-medium">{{ $slot->day_of_week ?? '—' }}</span>
                                            <span>{{ $slot->start_time ?? '' }} – {{ $slot->end_time ?? '' }}</span>
                                            @if($slot->room)<span class="text-gray-500">Room: {{ $slot->room }}</span>@endif
                                            @if($slot->semester)<span class="text-gray-500">Semester: {{ $slot->semester }}</span>@endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="mt-2 text-sm text-gray-500">No schedule slots set for this unit yet.</p>
                            @endif
                        </div>
                    @endforeach
                </div>
                <p class="mt-4 text-sm text-gray-500">Exam schedule and academic calendar can be added by admin.</p>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-8 text-center">
                    <p class="text-gray-500">You have no enrolled units. Your timetable will appear here after you register.</p>
                    <a href="{{ route('student.units.index') }}" class="inline-block mt-3 text-indigo-600 hover:underline">Book units</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
