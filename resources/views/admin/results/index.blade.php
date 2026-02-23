<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">View Results</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="get" class="mb-4 flex gap-2 flex-wrap">
                <select name="semester" class="rounded-md border-gray-300">
                    <option value="">All semesters</option>
                    @php $semesters = \App\Models\Enrollment::distinct()->pluck('semester')->filter(); @endphp
                    @foreach($semesters as $s)
                        <option value="{{ $s }}" {{ request('semester') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
                <select name="unit_id" class="rounded-md border-gray-300">
                    <option value="">All units</option>
                    @foreach($units as $u)
                        <option value="{{ $u->id }}" {{ request('unit_id') == $u->id ? 'selected' : '' }}>{{ $u->code }} - {{ $u->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm text-white hover:bg-indigo-500">Filter</button>
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Semester</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($enrollments as $e)
                            <tr>
                                <td class="px-4 py-2">{{ $e->student->reg_no ?? '—' }} — {{ $e->student->user->name ?? '—' }}</td>
                                <td class="px-4 py-2">{{ $e->unit->code ?? '—' }} {{ $e->unit->name ?? '' }}</td>
                                <td class="px-4 py-2">{{ $e->semester ?? '—' }}</td>
                                <td class="px-4 py-2">{{ $e->grade->grade ?? '—' }}</td>
                                <td class="px-4 py-2">{{ $e->grade->score ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-4 text-gray-500">No results.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $enrollments->links() }}</div>
        </div>
    </div>
</x-app-layout>
