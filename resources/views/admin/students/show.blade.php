<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Student: {{ $student->user->name }}</h2>
            <a href="{{ route('admin.students.edit', $student) }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Edit</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div><dt class="text-sm text-gray-500">Reg No</dt><dd class="font-medium">{{ $student->reg_no }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Name</dt><dd class="font-medium">{{ $student->user->name }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Email</dt><dd class="font-medium">{{ $student->user->email }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Phone</dt><dd class="font-medium">{{ $student->phone ?? '—' }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Programme</dt><dd class="font-medium">{{ $student->programme ?? '—' }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Year</dt><dd class="font-medium">{{ $student->year_of_study }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Status</dt><dd class="font-medium">{{ $student->status }}</dd></div>
                </dl>
            </div>
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-900 mb-2">Enrolled Units</h3>
                @if($student->enrollments->where('status', 'enrolled')->count())
                    <ul class="list-disc list-inside">
                        @foreach($student->enrollments->where('status', 'enrolled') as $e)
                            <li>{{ $e->unit->code }} — {{ $e->unit->name }} ({{ $e->semester ?? '—' }})</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No enrollments.</p>
                @endif
            </div>
            <div>
                <a href="{{ route('admin.students.index') }}" class="text-indigo-600 hover:underline">← Back to Students</a>
            </div>
        </div>
    </div>
</x-app-layout>
