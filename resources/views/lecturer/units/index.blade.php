<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Units / Courses</h2>
    </x-slot>

    <div class="space-y-6">
        <p class="text-sm text-gray-600">Units assigned to you by admin. View details, schedule, and materials.</p>

        @if($units->count())
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($units as $u)
                    <a href="{{ route('lecturer.units.show', $u) }}" class="block rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:border-indigo-200 hover:shadow-md">
                        <h3 class="font-semibold text-gray-900">{{ $u->code }} — {{ $u->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $u->enrollments_count }} students enrolled</p>
                        @if($u->timetable_slots && $u->timetableSlots->count())
                            <p class="mt-2 text-xs text-gray-400">{{ $u->timetableSlots->count() }} schedule slot(s)</p>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <div class="rounded-xl border border-gray-200 bg-white p-8 text-center text-gray-500">
                No units assigned yet. Contact admin to be assigned to units.
            </div>
        @endif
    </div>
</x-app-layout>
