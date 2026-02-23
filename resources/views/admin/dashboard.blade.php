<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-800">{{ session('success') }}</div>
            @endif

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
                <a href="{{ route('admin.students.index') }}" class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200/50 transition hover:shadow-md hover:ring-indigo-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Students</p>
                            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $stats['students'] }}</p>
                        </div>
                        <div class="rounded-lg bg-indigo-100 p-3 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                    </div>
                </a>
                <a href="{{ route('admin.lecturers.index') }}" class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200/50 transition hover:shadow-md hover:ring-emerald-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Lecturers</p>
                            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $stats['lecturers'] }}</p>
                        </div>
                        <div class="rounded-lg bg-emerald-100 p-3 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                    </div>
                </a>
                <a href="{{ route('admin.units.index') }}" class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200/50 transition hover:shadow-md hover:ring-amber-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Units</p>
                            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $stats['units'] }}</p>
                        </div>
                        <div class="rounded-lg bg-amber-100 p-3 text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                    </div>
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200/50 transition hover:shadow-md hover:ring-cyan-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Enrollments</p>
                            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $stats['enrollments'] }}</p>
                        </div>
                        <div class="rounded-lg bg-cyan-100 p-3 text-cyan-600 group-hover:bg-cyan-600 group-hover:text-white transition">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </div>
                    </div>
                </a>
                <a href="{{ route('admin.announcements.index') }}" class="group relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200/50 transition hover:shadow-md hover:ring-violet-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Announcements</p>
                            <p class="mt-1 text-3xl font-bold text-gray-900">{{ $stats['announcements'] }}</p>
                        </div>
                        <div class="rounded-lg bg-violet-100 p-3 text-violet-600 group-hover:bg-violet-600 group-hover:text-white transition">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Main content grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Recent Enrollments --}}
                <div class="lg:col-span-2 rounded-xl bg-white shadow-sm ring-1 ring-gray-200/50 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold text-gray-900">Recent Activities</h3>
                            <a href="{{ route('admin.bookings.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all →</a>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse($recentEnrollments as $e)
                            <div class="px-6 py-3 flex items-center justify-between hover:bg-gray-50/50">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-indigo-100 text-indigo-600 text-sm font-medium">{{ strtoupper(substr($e->student->user->name ?? '?', 0, 1)) }}</span>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $e->student->user->name ?? '—' }}</p>
                                        <p class="text-sm text-gray-500">{{ $e->student->reg_no ?? '' }} · {{ $e->unit->code ?? '—' }}</p>
                                    </div>
                                </div>
                                <span class="text-sm text-gray-400">{{ $e->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <div class="px-6 py-8 text-center text-gray-500">No recent enrollments</div>
                        @endforelse
                    </div>
                </div>

                {{-- Quick Actions & Announcements --}}
                <div class="space-y-6">
                    <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200/50 p-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-2">
                            <a href="{{ route('admin.students.create') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition">
                                <span class="text-indigo-500">+</span> Add Student
                            </a>
                            <a href="{{ route('admin.lecturers.create') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition">
                                <span class="text-indigo-500">+</span> Add Lecturer
                            </a>
                            <a href="{{ route('admin.units.create') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition">
                                <span class="text-indigo-500">+</span> Create Unit
                            </a>
                            <a href="{{ route('admin.announcements.create') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition">
                                <span class="text-indigo-500">+</span> Create Announcement
                            </a>
                            <a href="{{ route('admin.reports.analytics') }}" class="flex items-center gap-2 rounded-lg px-3 py-2 text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 transition">
                                <i class="fa-solid fa-chart-line text-indigo-500"></i> View Analytics
                            </a>
                        </div>
                    </div>

                    {{-- Recent Announcements --}}
                    <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200/50 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold text-gray-900">Recent Announcements</h3>
                                <a href="{{ route('admin.announcements.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all</a>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @forelse($recentAnnouncements as $a)
                                <a href="{{ route('admin.announcements.show', $a) }}" class="block px-6 py-3 hover:bg-gray-50/50">
                                    <p class="font-medium text-gray-900 truncate">{{ $a->title }}</p>
                                    <p class="text-sm text-gray-500">{{ $a->user->name ?? '—' }} · {{ $a->created_at->diffForHumans() }}</p>
                                </a>
                            @empty
                                <div class="px-6 py-6 text-center text-gray-500 text-sm">No announcements yet</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Analytics charts (Chart.js) --}}
            <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200/50 p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Unit enrollment</h3>
                    <div class="h-64">
                        <canvas id="chartEnrollment"></canvas>
                    </div>
                </div>
                <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200/50 p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Students by year</h3>
                    <div class="h-64">
                        <canvas id="chartYear"></canvas>
                    </div>
                </div>
            </div>

            {{-- Top units list --}}
            <div class="mt-6 rounded-xl bg-white shadow-sm ring-1 ring-gray-200/50 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Top units by enrollment</h3>
                @if($topUnitsByEnrollment->isNotEmpty())
                    <div class="flex flex-wrap gap-2">
                        @foreach($topUnitsByEnrollment as $u)
                            <a href="{{ route('admin.units.show', $u) }}" class="inline-flex items-center gap-2 rounded-lg bg-gray-50 px-3 py-2 text-sm hover:bg-indigo-50 transition">
                                <span class="font-medium text-gray-900">{{ $u->code }}</span>
                                <span class="rounded-full bg-indigo-100 px-2 py-0.5 text-xs font-medium text-indigo-700">{{ $u->enrollments_count }}</span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">No enrollments yet</p>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <script>
        (function () {
            const enrollmentCtx = document.getElementById('chartEnrollment');
            if (enrollmentCtx) {
                new Chart(enrollmentCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($chartEnrollmentLabels ?? []),
                        datasets: [{
                            label: 'Enrollments',
                            data: @json($chartEnrollmentData ?? []),
                            backgroundColor: 'rgba(79, 70, 229, 0.6)',
                            borderColor: 'rgb(79, 70, 229)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { stepSize: 1 } }
                        }
                    }
                });
            }
            const yearCtx = document.getElementById('chartYear');
            if (yearCtx) {
                new Chart(yearCtx, {
                    type: 'bar',
                    data: {
                        labels: @json($chartYearLabels ?? []),
                        datasets: [{
                            label: 'Students',
                            data: @json($chartYearData ?? []),
                            backgroundColor: 'rgba(16, 185, 129, 0.6)',
                            borderColor: 'rgb(16, 185, 129)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { stepSize: 1 } }
                        }
                    }
                });
            }
        })();
    </script>
</x-app-layout>
