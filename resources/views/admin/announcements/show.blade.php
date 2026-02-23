<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $announcement->title }}</h2>
            <a href="{{ route('admin.announcements.edit', $announcement) }}" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Edit</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-600 whitespace-pre-wrap">{{ $announcement->body }}</p>
                <p class="text-sm text-gray-400 mt-4">By {{ $announcement->user->name ?? '—' }} · {{ $announcement->scope }} @if($announcement->unit) · {{ $announcement->unit->code }} @endif · {{ $announcement->created_at->format('d M Y H:i') }}</p>
                <a href="{{ route('admin.announcements.index') }}" class="inline-block mt-4 text-indigo-600 hover:underline">← Back to Announcements</a>
            </div>
        </div>
    </div>
</x-app-layout>
