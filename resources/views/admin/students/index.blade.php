<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Students</h2>
            <a href="{{ route('admin.students.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Add Student</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800">{{ session('success') }}</div>
            @endif
            <form method="get" class="mb-4 flex gap-2 flex-wrap">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, reg no" class="rounded-md border-gray-300 shadow-sm w-64">
                <select name="status" class="rounded-md border-gray-300">
                    <option value="">All statuses</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
                    <option value="graduated" {{ request('status') === 'graduated' ? 'selected' : '' }}>Graduated</option>
                </select>
                <button type="submit" class="rounded-md bg-gray-200 px-4 py-2 text-sm">Filter</button>
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Reg No</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Programme</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($students as $s)
                            <tr>
                                <td class="px-4 py-2">{{ $s->reg_no }}</td>
                                <td class="px-4 py-2">{{ $s->user->name }}</td>
                                <td class="px-4 py-2">{{ $s->user->email }}</td>
                                <td class="px-4 py-2">{{ $s->programme ?? '—' }}</td>
                                <td class="px-4 py-2">{{ $s->status }}</td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <a href="{{ route('admin.students.show', $s) }}" class="text-indigo-600 hover:underline">View</a>
                                    <a href="{{ route('admin.students.edit', $s) }}" class="text-indigo-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.students.destroy', $s) }}" method="post" class="inline" onsubmit="event.preventDefault(); window.confirmDelete(this, 'Remove this student?', 'Their account and related data may be affected.'); return false;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-4 text-gray-500">No students found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $students->links() }}</div>
        </div>
    </div>
</x-app-layout>
