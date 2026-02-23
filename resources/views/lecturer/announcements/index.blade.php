<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Announcements</h2>
                <p class="mt-0.5 text-sm text-gray-500">View and post announcements for your units</p>
            </div>
            <a href="{{ route('lecturer.announcements.create') }}" class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Post announcement
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if($announcements->count())
            <ul class="space-y-4">
                @foreach($announcements as $a)
                    <li class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm hover:border-gray-300 transition-colors">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="font-semibold text-gray-900">{{ $a->title }}</h3>
                                    @if($a->type ?? null)
                                        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $a->type === 'notice' ? 'bg-amber-100 text-amber-800' : 'bg-indigo-100 text-indigo-800' }}">
                                            {{ $a->type === 'notice' ? 'Notice' : 'News' }}
                                        </span>
                                    @endif
                                </div>
                                <p class="mt-1 text-sm text-gray-600">{{ Str::limit($a->body, 200) }}</p>
                                <p class="mt-2 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-gray-500">
                                    <span>{{ $a->unit ? $a->unit->code : 'Global' }}</span>
                                    <span>·</span>
                                    <span>{{ $a->created_at->format('M j, Y H:i') }}</span>
                                </p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{ $announcements->links() }}
        @else
            <div class="rounded-xl border border-gray-200 bg-white p-10 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-gray-100 text-gray-400"><i class="fa-solid fa-bullhorn text-2xl"></i></div>
                <h3 class="mt-4 text-sm font-medium text-gray-900">No announcements yet</h3>
                <p class="mt-1 text-sm text-gray-500">Post an announcement to notify students in your units.</p>
                <a href="{{ route('lecturer.announcements.create') }}" class="mt-4 inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Post one</a>
            </div>
        @endif
    </div>
</x-app-layout>
