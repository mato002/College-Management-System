<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Learning Materials') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="mb-4 text-gray-600">Notes, assignments, and resources from your unit lecturers.</p>

            @if($enrollments->count())
                <div class="space-y-4">
                    @foreach($enrollments as $e)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-5">
                            <h3 class="font-semibold text-gray-900">{{ $e->unit->code }} — {{ $e->unit->name }}</h3>
                            <p class="mt-2 text-sm text-gray-500">No materials uploaded yet for this unit. Your lecturer may add notes and assignments here.</p>
                            <p class="mt-2 text-xs text-gray-400">Download notes · Assignments · Lecturer resources (coming when lecturers add materials)</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-8 text-center">
                    <p class="text-gray-500">You have no enrolled units. Learning materials will appear per unit after you register.</p>
                    <a href="{{ route('student.units.index') }}" class="inline-block mt-3 text-indigo-600 hover:underline">Book units</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
