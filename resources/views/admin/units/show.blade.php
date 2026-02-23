<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $unit->code }} — {{ $unit->name }}</h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.units.assign.edit', $unit) }}" class="rounded-md bg-gray-200 px-4 py-2 text-sm hover:bg-gray-300">Assign Lecturers</a>
                <a href="{{ route('admin.units.edit', $unit) }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Edit</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="rounded-md bg-green-50 p-4 text-green-800">{{ session('success') }}</div>
            @endif
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div><dt class="text-sm text-gray-500">Code</dt><dd class="font-medium">{{ $unit->code }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Name</dt><dd class="font-medium">{{ $unit->name }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Semester</dt><dd class="font-medium">{{ $unit->semester ?? '—' }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Capacity</dt><dd class="font-medium">{{ $unit->capacity ?: 'Unlimited' }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Credits</dt><dd class="font-medium">{{ $unit->credits }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Status</dt><dd class="font-medium">{{ $unit->status }}</dd></div>
                </dl>
                @if($unit->description)
                    <div class="mt-4"><dt class="text-sm text-gray-500">Description</dt><dd class="mt-1">{{ $unit->description }}</dd></div>
                @endif
            </div>
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-900 mb-2">Lecturers</h3>
                @if($unit->lecturers->count())
                    <ul class="list-disc list-inside">
                        @foreach($unit->lecturers as $l)
                            <li><a href="{{ route('admin.lecturers.show', $l) }}" class="text-indigo-600 hover:underline">{{ $l->user->name }}</a> ({{ $l->pivot->semester ?? '—' }})</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No lecturers assigned. <a href="{{ route('admin.units.assign.edit', $unit) }}" class="text-indigo-600">Assign lecturers</a></p>
                @endif
            </div>
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-900 mb-2">Enrolled Students ({{ $unit->enrollments->where('status', 'enrolled')->count() }})</h3>
                @if($unit->enrollments->where('status', 'enrolled')->count())
                    <ul class="list-disc list-inside">
                        @foreach($unit->enrollments->where('status', 'enrolled') as $e)
                            <li><a href="{{ route('admin.students.show', $e->student) }}" class="text-indigo-600 hover:underline">{{ $e->student->reg_no }} — {{ $e->student->user->name }}</a></li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No enrollments.</p>
                @endif
            </div>
            <div>
                <a href="{{ route('admin.units.index') }}" class="text-indigo-600 hover:underline">← Back to Units</a>
            </div>
        </div>
    </div>
</x-app-layout>
