<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Book Units</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 rounded-md bg-red-50 p-4 text-red-800">{{ session('error') }}</div>
            @endif
            <form method="get" class="mb-4 flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by code or name" class="rounded-md border-gray-300 shadow-sm w-64">
                <button type="submit" class="rounded-md bg-gray-200 px-4 py-2 text-sm">Search</button>
            </form>
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @forelse($units as $u)
                    @php $enrolled = in_array($u->id, $myEnrollmentIds); @endphp
                    <div class="bg-white shadow-sm sm:rounded-lg p-4 border border-gray-200">
                        <h3 class="font-medium text-gray-900">{{ $u->code }} — {{ $u->name }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ Str::limit($u->description, 80) }}</p>
                        <p class="text-sm text-gray-500">Enrolled: {{ $u->enrollments_count ?? 0 }}{{ $u->capacity ? ' / ' . $u->capacity : ' (no limit)' }}</p>
                        @if($enrolled)
                            <form action="{{ route('student.units.destroy', $u) }}" method="post" class="mt-3" onsubmit="event.preventDefault(); window.confirmDelete(this, 'Drop this unit?', 'You will need to re-register to get back in.'); return false;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="semester" value="{{ $semester }}">
                                <button type="submit" class="text-sm text-red-600 hover:underline">Drop unit</button>
                            </form>
                        @else
                            @if($u->isFull($semester))
                                <p class="mt-2 text-sm text-amber-600">Full</p>
                            @else
                                <form action="{{ route('student.units.store') }}" method="post" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="unit_id" value="{{ $u->id }}">
                                    <input type="hidden" name="semester" value="{{ $semester }}">
                                    <button type="submit" class="text-sm text-indigo-600 hover:underline">Enroll</button>
                                </form>
                            @endif
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-gray-500">No units available.</div>
                @endforelse
            </div>
            <div class="mt-4">{{ $units->links() }}</div>
        </div>
    </div>
</x-app-layout>
