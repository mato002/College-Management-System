<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lecturer: {{ $lecturer->user->name }}</h2>
            <a href="{{ route('admin.lecturers.edit', $lecturer) }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Edit</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div><dt class="text-sm text-gray-500">Employee ID</dt><dd class="font-medium">{{ $lecturer->employee_id }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Name</dt><dd class="font-medium">{{ $lecturer->user->name }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Email</dt><dd class="font-medium">{{ $lecturer->user->email }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Phone</dt><dd class="font-medium">{{ $lecturer->phone ?? '—' }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Department</dt><dd class="font-medium">{{ $lecturer->department ?? '—' }}</dd></div>
                    <div><dt class="text-sm text-gray-500">Title</dt><dd class="font-medium">{{ $lecturer->title ?? '—' }}</dd></div>
                </dl>
            </div>
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-900 mb-2">Assigned Units</h3>
                @if($lecturer->units->count())
                    <ul class="list-disc list-inside">
                        @foreach($lecturer->units as $u)
                            <li>
                                {{ $u->code }} — {{ $u->name }}
                                @if($u->pivot->semester)
                                    ({{ $u->pivot->semester }})
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('admin.units.index') }}" class="inline-block mt-2 text-indigo-600 hover:underline text-sm">Manage unit assignments →</a>
                @else
                    <p class="text-gray-500">No units assigned.</p>
                    <a href="{{ route('admin.units.index') }}" class="inline-block mt-2 text-indigo-600 hover:underline text-sm">Assign from Units page →</a>
                @endif
            </div>
            <div>
                <a href="{{ route('admin.lecturers.index') }}" class="text-indigo-600 hover:underline">← Back to Lecturers</a>
            </div>
        </div>
    </div>
</x-app-layout>
