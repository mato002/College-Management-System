<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Unit Booking Management</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800">{{ session('success') }}</div>
            @endif
            <form method="get" class="mb-4 flex gap-2 flex-wrap">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search student or unit" class="rounded-md border-gray-300 shadow-sm w-64">
                <select name="status" class="rounded-md border-gray-300">
                    <option value="">All statuses</option>
                    <option value="enrolled" {{ request('status') === 'enrolled' ? 'selected' : '' }}>Enrolled</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="dropped" {{ request('status') === 'dropped' ? 'selected' : '' }}>Dropped</option>
                </select>
                <input type="text" name="semester" value="{{ request('semester') }}" placeholder="Semester" class="rounded-md border-gray-300 w-32">
                <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm text-white hover:bg-indigo-500">Filter</button>
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Semester</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Enrolled At</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($bookings as $b)
                            <tr>
                                <td class="px-4 py-2">{{ $b->student->reg_no ?? '—' }} — {{ $b->student->user->name ?? '—' }}</td>
                                <td class="px-4 py-2">{{ $b->unit->code ?? '—' }} — {{ $b->unit->name ?? '—' }}</td>
                                <td class="px-4 py-2">{{ $b->semester ?? '—' }}</td>
                                <td class="px-4 py-2"><span class="px-2 py-0.5 rounded text-xs {{ $b->status === 'enrolled' ? 'bg-green-100 text-green-800' : ($b->status === 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-800') }}">{{ $b->status }}</span></td>
                                <td class="px-4 py-2">{{ $b->enrolled_at?->format('d M Y') ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-4 text-gray-500">No bookings found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $bookings->links() }}</div>
        </div>
    </div>
</x-app-layout>
