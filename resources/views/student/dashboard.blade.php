<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="rounded-md bg-green-50 p-4 text-green-800">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="rounded-md bg-red-50 p-4 text-red-800">{{ session('error') }}</div>
            @endif

            {{-- Quick stats --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-5 border border-gray-100">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Registered Units</p>
                    <p class="mt-2 text-2xl font-bold text-indigo-600">{{ $stats['units'] ?? 0 }}</p>
                    <p class="mt-1 text-xs text-gray-500">Current semester enrollments.</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-5 border border-gray-100">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Completed Units</p>
                    <p class="mt-2 text-2xl font-bold text-emerald-600">{{ $stats['completed_units'] ?? 0 }}</p>
                    <p class="mt-1 text-xs text-gray-500">Units with posted grades.</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-5 border border-gray-100">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Average Score / GPA</p>
                    @if($stats['average_score'] ?? null)
                        <p class="mt-2 text-2xl font-bold text-gray-900">{{ $stats['average_score'] }} <span class="text-sm font-semibold text-gray-500">({{ $stats['gpa'] }})</span></p>
                        <p class="mt-1 text-xs text-gray-500">Approximate GPA based on your graded units.</p>
                    @else
                        <p class="mt-2 text-2xl font-bold text-gray-400">—</p>
                        <p class="mt-1 text-xs text-gray-500">No grades posted yet.</p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Overview of registered units --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
                    <h3 class="font-medium text-gray-900 mb-3">My Enrolled Units</h3>
                    @if($enrollments->count())
                        <ul class="divide-y divide-gray-200">
                            @foreach($enrollments as $e)
                                <li class="py-2 flex justify-between items-center">
                                    <span class="font-medium text-gray-800">{{ $e->unit->code }}</span>
                                    <span class="text-sm text-gray-500">{{ $e->unit->name }} · {{ $e->semester ?? '—' }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <p class="mt-4">
                            <a href="{{ route('student.my-units.index') }}" class="text-indigo-600 hover:underline font-medium">View My Units →</a>
                            &nbsp;·&nbsp;
                            <a href="{{ route('student.units.index') }}" class="text-indigo-600 hover:underline font-medium">Book / Drop units →</a>
                        </p>
                    @else
                        <p class="text-gray-500">You have not enrolled in any units yet.</p>
                        <a href="{{ route('student.units.index') }}" class="inline-block mt-3 rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Browse & book units</a>
                    @endif
                </div>

                {{-- Upcoming classes (from timetable) --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
                    <h3 class="font-medium text-gray-900 mb-3">Upcoming Classes</h3>
                    @if($upcomingSlots && $upcomingSlots->count())
                        <ul class="space-y-2">
                            @foreach($upcomingSlots as $item)
                                <li class="text-sm text-gray-700">
                                    <span class="font-medium">{{ $item->unit->code ?? $item->unit->name }}</span>
                                    @if(isset($item->slot))
                                        — {{ $item->slot->day_of_week ?? '—' }} {{ $item->slot->start_time ?? '' }}-{{ $item->slot->end_time ?? '' }}
                                        @if(!empty($item->slot->room)) ({{ $item->slot->room }}) @endif
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('student.timetable.index') }}" class="mt-3 inline-block text-indigo-600 hover:underline font-medium">Full timetable →</a>
                    @else
                        <p class="text-gray-500">No upcoming classes in your schedule.</p>
                        <a href="{{ route('student.timetable.index') }}" class="mt-2 inline-block text-indigo-600 hover:underline">View timetable</a>
                    @endif
                </div>
            </div>

            {{-- Announcements --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
                <h3 class="font-medium text-gray-900 mb-3">Recent Announcements</h3>
                @if($recentAnnouncements && $recentAnnouncements->count())
                    <ul class="divide-y divide-gray-200">
                        @foreach($recentAnnouncements as $a)
                            <li class="py-3">
                                <p class="font-medium text-gray-800">{{ $a->title }}</p>
                                <p class="text-sm text-gray-500 mt-0.5">
                                    @if($a->unit_id) {{ $a->unit?->code ?? 'Unit' }} · @endif
                                    {{ $a->created_at?->diffForHumans() }}
                                </p>
                                <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ Str::limit(strip_tags($a->body ?? ''), 120) }}</p>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('student.announcements.index') }}" class="mt-3 inline-block text-indigo-600 hover:underline font-medium">All announcements →</a>
                @else
                    <p class="text-gray-500">No announcements yet.</p>
                    <a href="{{ route('student.announcements.index') }}" class="mt-2 inline-block text-indigo-600 hover:underline">View announcements</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
