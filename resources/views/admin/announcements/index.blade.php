<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Announcements</h2>
            <a href="{{ route('admin.announcements.create') }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Create Announcement</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="get" class="mb-4">
                <select name="scope" class="rounded-md border-gray-300" onchange="this.form.submit()">
                    <option value="">All scopes</option>
                    <option value="global" {{ request('scope') === 'global' ? 'selected' : '' }}>Global</option>
                    <option value="unit" {{ request('scope') === 'unit' ? 'selected' : '' }}>Unit-specific</option>
                </select>
            </form>
            <div class="space-y-4">
                @forelse($announcements as $a)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $a->title }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ Str::limit($a->body, 120) }}</p>
                                <p class="text-xs text-gray-400 mt-2">By {{ $a->user->name ?? '—' }} · {{ $a->scope }} @if($a->unit) · {{ $a->unit->code }} @endif · {{ $a->created_at->format('d M Y') }}</p>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.announcements.show', $a) }}" class="text-indigo-600 hover:underline text-sm">View</a>
                                <a href="{{ route('admin.announcements.edit', $a) }}" class="text-indigo-600 hover:underline text-sm">Edit</a>
                                <form action="{{ route('admin.announcements.destroy', $a) }}" method="post" class="inline" onsubmit="event.preventDefault(); window.confirmDelete(this, 'Delete this announcement?', 'You won\'t be able to revert this.'); return false;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 text-center text-gray-500">No announcements.</div>
                @endforelse
            </div>
            <div class="mt-4">{{ $announcements->links() }}</div>
        </div>
    </div>
</x-app-layout>
