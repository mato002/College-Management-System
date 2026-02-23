<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Results / Grades') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="mb-4 text-gray-600">View your results and academic performance for enrolled units.</p>

            @if($enrollments->count())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Score / Grade</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($enrollments as $e)
                                @php $grade = $e->grades->first(); @endphp
                                <tr>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $e->unit->code }} — {{ $e->unit->name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $grade ? ($grade->score ?? $grade->grade ?? '—') : '—' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">—</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="mt-4 text-sm text-gray-500">GPA and performance summary will appear here when grades are published by lecturers.</p>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-8 text-center">
                    <p class="text-gray-500">You have no enrolled units. Results will show here after you register for units and grades are entered.</p>
                    <a href="{{ route('student.units.index') }}" class="inline-block mt-3 text-indigo-600 hover:underline">Book units</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
