<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Grades / Results</h2>
    </x-slot>

    <div class="space-y-4">
        @if(session('success'))
            <div class="rounded-lg bg-green-50 p-4 text-sm text-green-800">{{ session('success') }}</div>
        @endif

        <form method="get" class="flex flex-wrap items-center gap-2">
            <select name="unit_id" class="rounded-lg border border-gray-300 text-sm" onchange="this.form.submit()">
                <option value="">All units</option>
                @foreach($units as $u)
                    <option value="{{ $u->id }}" {{ request('unit_id') == $u->id ? 'selected' : '' }}>{{ $u->code }} — {{ $u->name }}</option>
                @endforeach
            </select>
        </form>

        @if($enrollments->count())
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($enrollments as $e)
                            @php $grade = $e->grades->first(); @endphp
                            <tr>
                                <td class="px-4 py-2 text-sm">{{ $e->student->user->name }} ({{ $e->student->reg_no }})</td>
                                <td class="px-4 py-2 text-sm">{{ $e->unit->code }}</td>
                                <td class="px-4 py-2 text-sm">{{ $grade?->score ?? '—' }}</td>
                                <td class="px-4 py-2 text-sm">{{ $grade?->grade ?? '—' }}</td>
                                <td class="px-4 py-2 text-right">
                                    <a href="{{ route('lecturer.grades.edit', $e) }}" class="text-sm font-medium text-indigo-600 hover:underline">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $enrollments->links() }}
        @else
            <div class="rounded-xl border border-gray-200 bg-white p-8 text-center text-gray-500">
                No enrollments in your units, or no unit selected.
            </div>
        @endif
    </div>
</x-app-layout>
