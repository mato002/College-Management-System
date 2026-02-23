<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Assign Lecturers — {{ $unit->code }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="post" action="{{ route('admin.units.assign.update', $unit) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <x-input-label for="semester" value="Semester (for this assignment)" />
                        <x-text-input id="semester" name="semester" class="block mt-1 w-full" value="{{ old('semester', 'semester_1') }}" placeholder="semester_1" />
                    </div>
                    <div class="space-y-2">
                        <x-input-label value="Select lecturers" />
                        @foreach($lecturers as $l)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="lecturers[]" value="{{ $l->id }}" {{ $unit->lecturers->contains($l) ? 'checked' : '' }} class="rounded border-gray-300">
                                <span>{{ $l->user->name }} ({{ $l->employee_id }})</span>
                            </label>
                        @endforeach
                    </div>
                    <div class="mt-6 flex gap-2">
                        <x-primary-button>Save</x-primary-button>
                        <a href="{{ route('admin.units.show', $unit) }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
