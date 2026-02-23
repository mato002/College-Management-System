<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        {{-- Search form (mirrors header, but full-width for accessibility) --}}
        <form method="GET" action="{{ route('search') }}" class="flex items-center gap-3 rounded-lg border border-gray-200 bg-white px-3 py-2 shadow-sm">
            <svg class="h-5 w-5 shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input
                type="search"
                name="q"
                value="{{ $query }}"
                placeholder="Search by name, email, reg no, employee ID, unit code..."
                class="block w-full border-none bg-transparent text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-0"
                autofocus
            />
            @if($query !== '')
                <a href="{{ route('search') }}" class="text-xs text-gray-500 hover:text-gray-700">Clear</a>
            @endif
            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-indigo-500">
                Search
            </button>
        </form>

        @if($query === '')
            <div class="rounded-xl border border-dashed border-gray-200 bg-white/60 p-8 text-center text-gray-500">
                <p class="text-sm">Type a keyword above to search {{ $type === 'admin' ? 'students, lecturers, and units' : ($type === 'lecturer' ? 'your students and units' : 'units') }}.</p>
            </div>
        @else
            @php
                $hasResults = $students->isNotEmpty() || $lecturers->isNotEmpty() || $units->isNotEmpty();
            @endphp

            @unless($hasResults)
                <div class="rounded-xl border border-gray-200 bg-white p-8 text-center text-gray-500">
                    <p class="text-sm">No results found for "<span class="font-semibold">{{ $query }}</span>".</p>
                </div>
            @endunless

            <div class="grid gap-6 lg:grid-cols-{{ $type === 'admin' ? '3' : '2' }}">
                {{-- Students --}}
                @if($students->isNotEmpty())
                    <div class="space-y-3">
                        <h3 class="flex items-center gap-2 text-sm font-semibold text-gray-800">
                            <i class="fa-solid fa-user-graduate text-indigo-500"></i>
                            Students ({{ $students->count() }})
                        </h3>
                        <div class="space-y-2 rounded-xl border border-gray-200 bg-white p-3">
                            @foreach($students as $student)
                                <a href="{{ route('admin.students.show', $student) }}" class="block rounded-lg px-2 py-1.5 text-sm hover:bg-indigo-50">
                                    <div class="flex items-center justify-between gap-2">
                                        <div class="min-w-0">
                                            <p class="truncate font-medium text-gray-900">{{ $student->user?->name ?? 'Unknown student' }}</p>
                                            <p class="truncate text-xs text-gray-500">{{ $student->reg_no }} · {{ $student->user?->email }}</p>
                                        </div>
                                        <span class="text-[11px] font-medium uppercase tracking-wide text-gray-400">{{ $student->status }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Lecturers (admin only) --}}
                @if($lecturers->isNotEmpty())
                    <div class="space-y-3">
                        <h3 class="flex items-center gap-2 text-sm font-semibold text-gray-800">
                            <i class="fa-solid fa-chalkboard-teacher text-indigo-500"></i>
                            Lecturers ({{ $lecturers->count() }})
                        </h3>
                        <div class="space-y-2 rounded-xl border border-gray-200 bg-white p-3">
                            @foreach($lecturers as $lecturer)
                                <a href="{{ route('admin.lecturers.show', $lecturer) }}" class="block rounded-lg px-2 py-1.5 text-sm hover:bg-indigo-50">
                                    <p class="truncate font-medium text-gray-900">{{ $lecturer->user?->name ?? 'Unknown lecturer' }}</p>
                                    <p class="truncate text-xs text-gray-500">{{ $lecturer->employee_id }} · {{ $lecturer->department }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Units --}}
                @if($units->isNotEmpty())
                    <div class="space-y-3">
                        <h3 class="flex items-center gap-2 text-sm font-semibold text-gray-800">
                            <i class="fa-solid fa-book text-indigo-500"></i>
                            Units ({{ $units->count() }})
                        </h3>
                        <div class="space-y-2 rounded-xl border border-gray-200 bg-white p-3">
                            @foreach($units as $unit)
                                @php
                                    $unitShowRoute = auth()->user()->effectiveType() === 'admin'
                                        ? route('admin.units.show', $unit)
                                        : route('lecturer.units.show', $unit->id);
                                @endphp
                                <a href="{{ $unitShowRoute }}" class="block rounded-lg px-2 py-1.5 text-sm hover:bg-indigo-50">
                                    <p class="font-medium text-gray-900">{{ $unit->code }} — {{ $unit->name }}</p>
                                    <p class="text-xs text-gray-500">Credits: {{ $unit->credits }} · Status: {{ $unit->status }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-app-layout>

