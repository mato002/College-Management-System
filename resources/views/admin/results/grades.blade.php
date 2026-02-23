<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Grades</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="get" class="mb-4 flex gap-2">
                <select name="semester" class="rounded-md border-gray-300">
                    <option value="">All semesters</option>
                    @foreach(\App\Models\Grade::distinct()->pluck('semester')->filter() as $s)
                        <option value="{{ $s }}" {{ request('semester') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm text-white">Filter</button>
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Semester</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Score</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($grades as $g)
                            <tr>
                                <td class="px-4 py-2">{{ $g->enrollment->student->reg_no ?? '—' }} — {{ $g->enrollment->student->user->name ?? '—' }}</td>
                                <td class="px-4 py-2">{{ $g->enrollment->unit->code ?? '—' }} {{ $g->enrollment->unit->name ?? '' }}</td>
                                <td class="px-4 py-2">{{ $g->semester ?? '—' }}</td>
                                <td class="px-4 py-2">{{ $g->score ?? '—' }}</td>
                                <td class="px-4 py-2">{{ $g->grade ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-4 text-gray-500">No grades recorded.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $grades->links() }}</div>
        </div>
    </div>
</x-app-layout>
