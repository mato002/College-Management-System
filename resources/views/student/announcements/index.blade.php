<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Announcements / Updates') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="mb-4 text-gray-600">College notices, lecturer updates, and system notifications.</p>

            @if($announcements->count())
                <div class="space-y-4">
                    @foreach($announcements as $a)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-5">
                            <h3 class="font-semibold text-gray-900">{{ $a->title }}</h3>
                            <p class="text-sm text-gray-500 mt-0.5">
                                @if($a->unit_id) <span class="font-medium text-gray-600">{{ $a->unit?->code ?? 'Unit' }}</span> · @endif
                                {{ $a->created_at?->format('M j, Y H:i') }}
                            </p>
                            <div class="mt-3 text-gray-700 prose prose-sm max-w-none">{{ $a->body ? nl2br(e($a->body)) : '—' }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $announcements->links() }}</div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-8 text-center">
                    <p class="text-gray-500">No announcements at the moment.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
