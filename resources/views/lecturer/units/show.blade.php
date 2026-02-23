<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $unit->code }} — {{ $unit->name }}</h2>
            <a href="{{ route('lecturer.units.index') }}" class="text-sm font-medium text-indigo-600 hover:underline">← My units</a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="grid gap-4 sm:grid-cols-2">
            <div class="rounded-xl border border-gray-200 bg-white p-5">
                <h3 class="text-sm font-medium text-gray-500">Enrolled students</h3>
                <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $unit->enrollments->count() }}</p>
                <a href="{{ route('lecturer.students.index', ['unit_id' => $unit->id]) }}" class="mt-2 inline-block text-sm text-indigo-600 hover:underline">View list</a>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-5">
                <h3 class="text-sm font-medium text-gray-500">Schedule</h3>
                @if($unit->timetableSlots->count())
                    <ul class="mt-2 space-y-1 text-sm">
                        @foreach($unit->timetableSlots as $slot)
                            <li>{{ $slot->day_of_week }} {{ $slot->start_time }}–{{ $slot->end_time }} {{ $slot->room ? "({$slot->room})" : '' }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="mt-1 text-gray-500">No schedule set.</p>
                    <a href="{{ route('lecturer.timetable.index') }}" class="mt-2 inline-block text-sm text-indigo-600 hover:underline">Timetable</a>
                @endif
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6">
            <h3 class="text-base font-semibold text-gray-900">Students in this unit</h3>
            @if($unit->enrollments->count())
                <ul class="mt-4 divide-y divide-gray-100">
                    @foreach($unit->enrollments as $e)
                        <li class="flex items-center justify-between py-3">
                            <span>{{ $e->student->reg_no }} — {{ $e->student->user->name }}</span>
                            <a href="{{ route('lecturer.grades.edit', $e) }}" class="text-sm text-indigo-600 hover:underline">Edit grade</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="mt-4 text-gray-500">No enrollments yet.</p>
            @endif
        </div>

        <div class="flex gap-3">
            <a href="{{ route('lecturer.materials.index') }}" class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">Teaching materials</a>
            <a href="{{ route('lecturer.grades.index', ['unit_id' => $unit->id]) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Grades for this unit</a>
        </div>
    </div>
</x-app-layout>
