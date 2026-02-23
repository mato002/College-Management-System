<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lecturer Dashboard</h2>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="rounded-lg bg-green-50 p-4 text-sm text-green-800">{{ session('success') }}</div>
        @endif

        {{-- Quick stats --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <a href="{{ route('lecturer.units.index') }}" class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:border-indigo-200 hover:shadow-md">
                <p class="text-sm font-medium text-gray-500">Assigned Units</p>
                <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['units'] }}</p>
            </a>
            <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                <p class="text-sm font-medium text-gray-500">Total Students</p>
                <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['students'] }}</p>
            </div>
            <a href="{{ route('lecturer.announcements.index') }}" class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:border-indigo-200 hover:shadow-md">
                <p class="text-sm font-medium text-gray-500">My Announcements</p>
                <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $stats['announcements'] }}</p>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            {{-- My assigned units (overview) --}}
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="text-base font-semibold text-gray-900">My Assigned Units</h3>
                <p class="mt-1 text-sm text-gray-500">Total students per unit</p>
                @if($units->count())
                    <ul class="mt-4 space-y-3">
                        @foreach($units as $u)
                            <li class="flex items-center justify-between rounded-lg border border-gray-100 py-2 px-3">
                                <a href="{{ route('lecturer.units.show', $u) }}" class="font-medium text-indigo-600 hover:underline">{{ $u->code }} — {{ $u->name }}</a>
                                <span class="text-sm text-gray-500">{{ $u->enrollments_count }} students</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('lecturer.units.index') }}" class="mt-4 inline-block text-sm font-medium text-indigo-600 hover:underline">View all units →</a>
                @else
                    <p class="mt-4 text-gray-500">No units assigned yet. Contact admin.</p>
                @endif
            </div>

            {{-- Recent announcements --}}
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-gray-900">Recent Announcements</h3>
                    <a href="{{ route('lecturer.announcements.create') }}" class="text-sm font-medium text-indigo-600 hover:underline">Post new</a>
                </div>
                @if($recentAnnouncements->count())
                    <ul class="mt-4 space-y-3">
                        @foreach($recentAnnouncements as $a)
                            <li class="rounded-lg border border-gray-100 py-2 px-3">
                                <p class="font-medium text-gray-900">{{ $a->title }}</p>
                                <p class="text-xs text-gray-500">{{ $a->unit?->code ?? 'Global' }} · {{ $a->created_at->diffForHumans() }}</p>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('lecturer.announcements.index') }}" class="mt-4 inline-block text-sm font-medium text-indigo-600 hover:underline">View all →</a>
                @else
                    <p class="mt-4 text-gray-500">No announcements yet.</p>
                @endif
            </div>
        </div>

        {{-- Quick links (recent activities) --}}
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h3 class="text-base font-semibold text-gray-900">Quick actions</h3>
            <div class="mt-4 flex flex-wrap gap-3">
                <a href="{{ route('lecturer.grades.index') }}" class="rounded-lg bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-700 hover:bg-indigo-100">Upload grades</a>
                <a href="{{ route('lecturer.announcements.create') }}" class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">Post announcement</a>
                <a href="{{ route('lecturer.attendance.index') }}" class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">Mark attendance</a>
                <a href="{{ route('lecturer.timetable.index') }}" class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">View timetable</a>
            </div>
        </div>
    </div>
</x-app-layout>
