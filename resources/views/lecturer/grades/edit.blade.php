<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit grade — {{ $enrollment->student->user->name }}</h2>
            <a href="{{ route('lecturer.grades.index', ['unit_id' => $enrollment->unit_id]) }}" class="text-sm font-medium text-indigo-600 hover:underline">← Back to grades</a>
        </div>
    </x-slot>

    <div class="max-w-md">
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">{{ $enrollment->student->reg_no }} · {{ $enrollment->unit->code }}</p>
            @php $grade = $enrollment->grades->first(); @endphp
            <form method="post" action="{{ route('lecturer.grades.update', $enrollment) }}" class="mt-4 space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="score" class="block text-sm font-medium text-gray-700">Score</label>
                    <input type="number" id="score" name="score" min="0" max="100" step="0.01" value="{{ old('score', $grade?->score) }}" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm">
                    <x-input-error :messages="$errors->get('score')" class="mt-1" />
                </div>
                <div>
                    <label for="grade" class="block text-sm font-medium text-gray-700">Grade (e.g. A, B+)</label>
                    <input type="text" id="grade" name="grade" value="{{ old('grade', $grade?->grade) }}" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm" maxlength="8">
                    <x-input-error :messages="$errors->get('grade')" class="mt-1" />
                </div>
                <div>
                    <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                    <input type="text" id="semester" name="semester" value="{{ old('semester', $grade?->semester ?? $enrollment->semester) }}" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm" placeholder="e.g. semester_1">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Save grade</button>
                    <a href="{{ route('lecturer.grades.index', ['unit_id' => $enrollment->unit_id]) }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
