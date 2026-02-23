@php
    $user = auth()->user();
@endphp

<!-- Mobile overlay when sidebar open -->
<div x-show="sidebarOpen" x-transition class="fixed inset-0 z-40 bg-gray-900/60 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false" x-cloak aria-hidden="true"></div>

<!-- Sidebar: fixed, full height, collapsible on desktop (lg:w-20 when collapsed) -->
<aside class="fixed inset-y-0 left-0 z-50 flex flex-col bg-white shadow-lg ring-1 ring-black/5 transition-[width] duration-200"
       :class="sidebarOpen ? 'flex w-64' : ['hidden', 'lg:flex', sidebarCollapsed ? 'lg:w-20' : 'lg:w-64']"
       x-cloak>

    {{-- Branding + collapse toggle --}}
    <div class="flex h-16 shrink-0 items-center border-b border-gray-100 bg-gray-50/80 px-3 transition-[padding] duration-200 lg:px-3"
         :class="sidebarCollapsed ? 'justify-center' : 'gap-3 px-5'">
        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-600 text-white font-bold text-sm shadow-sm">C</span>
        <span class="truncate text-sm font-semibold tracking-tight text-gray-800 transition-opacity duration-200" x-show="!sidebarCollapsed" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">{{ config('app.name') }}</span>
        <button type="button" @click="sidebarCollapsed = !sidebarCollapsed; localStorage.setItem('sidebarCollapsed', sidebarCollapsed)" class="hidden shrink-0 rounded-lg p-2 text-gray-500 hover:bg-gray-200 hover:text-gray-700 lg:block" :class="sidebarCollapsed ? '' : 'ml-auto'" :title="sidebarCollapsed ? 'Expand sidebar' : 'Collapse sidebar'" aria-label="Toggle sidebar">
            <svg class="h-5 w-5 transition-transform duration-200" :class="sidebarCollapsed ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/></svg>
        </button>
    </div>

    {{-- Nav: scrollable; when collapsed only icons show (labels have x-show="!sidebarCollapsed") --}}
    <div class="sidebar-nav min-h-0 flex-1 flex flex-col overflow-y-auto overflow-x-hidden py-4" :class="sidebarCollapsed ? 'overflow-x-hidden' : ''">
        <nav class="flex flex-1 flex-col px-3" :class="sidebarCollapsed ? 'px-2' : ''">
            <ul role="list" class="flex flex-1 flex-col gap-y-1">
                @if($user->isSuperAdmin())
                    {{-- Dashboard --}}
                    <li>
                        <a href="{{ route('admin.dashboard') }}" title="Dashboard" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active' : '' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors" :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                            <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-gauge-high"></i></span>
                            <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Dashboard</span>
                        </a>
                    </li>
                    {{-- Student Management --}}
                    <li x-data="{ open: {{ request()->routeIs('admin.students.*') ? 'true' : 'false' }} }">
                        <button @click="sidebarCollapsed ? (sidebarCollapsed = false, localStorage.setItem('sidebarCollapsed', false), open = true) : (open = !open)" type="button" title="Student Management" class="sidebar-link flex w-full items-center rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-users"></i></span>
                                <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Student Management</span>
                            </span>
                            <span x-show="!sidebarCollapsed" class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open && !sidebarCollapsed" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('admin.students.index') }}" class="sidebar-sublink {{ request()->routeIs('admin.students.index') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">View Students</a></li>
                            <li><a href="{{ route('admin.students.create') }}" class="sidebar-sublink {{ request()->routeIs('admin.students.create') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Add Student</a></li>
                            <li><a href="{{ route('admin.students.index') }}" class="sidebar-sublink block rounded-md py-2 pl-2 text-xs font-medium">Student Profiles</a></li>
                        </ul>
                    </li>
                    {{-- Lecturer Management --}}
                    <li x-data="{ open: {{ request()->routeIs('admin.lecturers.*') ? 'true' : 'false' }} }">
                        <button @click="sidebarCollapsed ? (sidebarCollapsed = false, localStorage.setItem('sidebarCollapsed', false), open = true) : (open = !open)" type="button" title="Lecturer Management" class="sidebar-link flex w-full items-center rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-chalkboard-teacher"></i></span>
                                <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Lecturer Management</span>
                            </span>
                            <span x-show="!sidebarCollapsed" class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open && !sidebarCollapsed" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('admin.lecturers.index') }}" class="sidebar-sublink {{ request()->routeIs('admin.lecturers.index') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">View Lecturers</a></li>
                            <li><a href="{{ route('admin.lecturers.create') }}" class="sidebar-sublink {{ request()->routeIs('admin.lecturers.create') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Add Lecturer</a></li>
                            <li><a href="{{ route('admin.academic.departments') }}" class="sidebar-sublink block rounded-md py-2 pl-2 text-xs font-medium">Departments</a></li>
                        </ul>
                    </li>
                    {{-- Unit / Course Management --}}
                    <li x-data="{ open: {{ request()->routeIs('admin.units.*') && !request()->routeIs('admin.bookings.*') ? 'true' : 'false' }} }">
                        <button @click="sidebarCollapsed ? (sidebarCollapsed = false, localStorage.setItem('sidebarCollapsed', false), open = true) : (open = !open)" type="button" title="Unit / Course Mgmt" class="sidebar-link flex w-full items-center rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-book"></i></span>
                                <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Unit / Course Mgmt</span>
                            </span>
                            <span x-show="!sidebarCollapsed" class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open && !sidebarCollapsed" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('admin.units.index') }}" class="sidebar-sublink {{ request()->routeIs('admin.units.index') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">View Units</a></li>
                            <li><a href="{{ route('admin.units.create') }}" class="sidebar-sublink {{ request()->routeIs('admin.units.create') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Create Unit</a></li>
                            <li><a href="{{ route('admin.units.index') }}" class="sidebar-sublink block rounded-md py-2 pl-2 text-xs font-medium">Assign Lecturers</a></li>
                        </ul>
                    </li>
                    {{-- Unit Booking Management --}}
                    <li x-data="{ open: {{ request()->routeIs('admin.bookings.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open" type="button" class="sidebar-link flex w-full items-center justify-between rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-calendar-check"></i></span>
                                <span>Unit Bookings</span>
                            </span>
                            <span class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('admin.bookings.index') }}" class="sidebar-sublink {{ request()->routeIs('admin.bookings.index') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">View Bookings</a></li>
                            <li><a href="{{ route('admin.bookings.reports') }}" class="sidebar-sublink {{ request()->routeIs('admin.bookings.reports') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Enrollment Reports</a></li>
                        </ul>
                    </li>
                    {{-- Academic Management --}}
                    <li x-data="{ open: {{ request()->routeIs('admin.academic.*') ? 'true' : 'false' }} }">
                        <button @click="sidebarCollapsed ? (sidebarCollapsed = false, localStorage.setItem('sidebarCollapsed', false), open = true) : (open = !open)" type="button" title="Academic Mgmt" class="sidebar-link flex w-full items-center rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-graduation-cap"></i></span>
                                <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Academic Mgmt</span>
                            </span>
                            <span x-show="!sidebarCollapsed" class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open && !sidebarCollapsed" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('admin.academic.calendar') }}" class="sidebar-sublink {{ request()->routeIs('admin.academic.calendar') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Academic Calendar</a></li>
                            <li><a href="{{ route('admin.academic.semesters') }}" class="sidebar-sublink {{ request()->routeIs('admin.academic.semesters') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Semesters</a></li>
                            <li><a href="{{ route('admin.academic.timetable') }}" class="sidebar-sublink {{ request()->routeIs('admin.academic.timetable') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Timetable</a></li>
                            <li><a href="{{ route('admin.academic.departments') }}" class="sidebar-sublink {{ request()->routeIs('admin.academic.departments') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Departments</a></li>
                            <li><a href="{{ route('admin.academic.programs') }}" class="sidebar-sublink {{ request()->routeIs('admin.academic.programs') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Programs</a></li>
                        </ul>
                    </li>
                    {{-- Results & Grading --}}
                    <li x-data="{ open: {{ request()->routeIs('admin.results.*') ? 'true' : 'false' }} }">
                        <button @click="sidebarCollapsed ? (sidebarCollapsed = false, localStorage.setItem('sidebarCollapsed', false), open = true) : (open = !open)" type="button" title="Results & Grading" class="sidebar-link flex w-full items-center rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-marker"></i></span>
                                <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Results & Grading</span>
                            </span>
                            <span x-show="!sidebarCollapsed" class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open && !sidebarCollapsed" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('admin.results.index') }}" class="sidebar-sublink {{ request()->routeIs('admin.results.index') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">View Results</a></li>
                            <li><a href="{{ route('admin.results.grades') }}" class="sidebar-sublink {{ request()->routeIs('admin.results.grades') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Manage Grades</a></li>
                            <li><a href="{{ route('admin.results.settings') }}" class="sidebar-sublink {{ request()->routeIs('admin.results.settings') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">GPA Settings</a></li>
                            <li><a href="{{ route('admin.results.reports') }}" class="sidebar-sublink {{ request()->routeIs('admin.results.reports') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Performance Reports</a></li>
                        </ul>
                    </li>
                    {{-- Announcements --}}
                    <li x-data="{ open: {{ request()->routeIs('admin.announcements.*') ? 'true' : 'false' }} }">
                        <button @click="sidebarCollapsed ? (sidebarCollapsed = false, localStorage.setItem('sidebarCollapsed', false), open = true) : (open = !open)" type="button" title="Announcements" class="sidebar-link flex w-full items-center rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-bell"></i></span>
                                <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Announcements</span>
                            </span>
                            <span x-show="!sidebarCollapsed" class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open && !sidebarCollapsed" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('admin.announcements.index') }}" class="sidebar-sublink {{ request()->routeIs('admin.announcements.index') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">View All</a></li>
                            <li><a href="{{ route('admin.announcements.create') }}" class="sidebar-sublink {{ request()->routeIs('admin.announcements.create') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Create</a></li>
                        </ul>
                    </li>
                    {{-- Reports & Analytics --}}
                    <li x-data="{ open: {{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }} }">
                        <button @click="sidebarCollapsed ? (sidebarCollapsed = false, localStorage.setItem('sidebarCollapsed', false), open = true) : (open = !open)" type="button" title="Reports" class="sidebar-link flex w-full items-center rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-chart-line"></i></span>
                                <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Reports</span>
                            </span>
                            <span x-show="!sidebarCollapsed" class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open && !sidebarCollapsed" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('admin.reports.students') }}" class="sidebar-sublink {{ request()->routeIs('admin.reports.students') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Student Reports</a></li>
                            <li><a href="{{ route('admin.reports.enrollment') }}" class="sidebar-sublink {{ request()->routeIs('admin.reports.enrollment') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Unit Enrollment</a></li>
                            <li><a href="{{ route('admin.reports.lecturers') }}" class="sidebar-sublink {{ request()->routeIs('admin.reports.lecturers') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Lecturer Reports</a></li>
                            <li><a href="{{ route('admin.reports.analytics') }}" class="sidebar-sublink {{ request()->routeIs('admin.reports.analytics') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">System Stats</a></li>
                            <li><a href="{{ route('admin.activity-log.index') }}" class="sidebar-sublink {{ request()->routeIs('admin.activity-log.*') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Activity Log</a></li>
                        </ul>
                    </li>
                    {{-- System Settings --}}
                    <li x-data="{ open: {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }} }">
                        <button @click="sidebarCollapsed ? (sidebarCollapsed = false, localStorage.setItem('sidebarCollapsed', false), open = true) : (open = !open)" type="button" title="System Settings" class="sidebar-link flex w-full items-center rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-gear"></i></span>
                                <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">System Settings</span>
                            </span>
                            <span x-show="!sidebarCollapsed" class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open && !sidebarCollapsed" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('admin.settings.general') }}" class="sidebar-sublink {{ request()->routeIs('admin.settings.general') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">General</a></li>
                            <li><a href="{{ route('admin.settings.email') }}" class="sidebar-sublink {{ request()->routeIs('admin.settings.email') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Email</a></li>
                            <li><a href="{{ route('admin.roles.index') }}" class="sidebar-sublink {{ request()->routeIs('admin.roles.*') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Roles & Permissions</a></li>
                            <li><a href="{{ route('admin.settings.permissions') }}" class="sidebar-sublink {{ request()->routeIs('admin.settings.permissions') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Permissions</a></li>
                            <li><a href="{{ route('admin.settings.backup') }}" class="sidebar-sublink {{ request()->routeIs('admin.settings.backup') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Backup</a></li>
                        </ul>
                    </li>
                @elseif($user->isLecturer())
                    <p x-show="!sidebarCollapsed" x-transition class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-wider text-gray-400" style="display: none;">Lecturer</p>
                    {{-- 1. Dashboard --}}
                    <li>
                        <a href="{{ route('lecturer.dashboard') }}" title="Dashboard" class="sidebar-link {{ request()->routeIs('lecturer.dashboard') ? 'sidebar-link-active' : '' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors" :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                            <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-gauge-high"></i></span>
                            <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Dashboard</span>
                        </a>
                    </li>
                    {{-- 2. My Units / Courses --}}
                    <li x-data="{ open: {{ request()->routeIs('lecturer.units.*') ? 'true' : 'false' }} }">
                        <button @click="sidebarCollapsed ? (sidebarCollapsed = false, localStorage.setItem('sidebarCollapsed', false), open = true) : (open = !open)" type="button" title="My Units" class="sidebar-link flex w-full items-center rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-book"></i></span>
                                <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">My Units</span>
                            </span>
                            <span x-show="!sidebarCollapsed" class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open && !sidebarCollapsed" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('lecturer.units.index') }}" class="sidebar-sublink {{ request()->routeIs('lecturer.units.index') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">View Units</a></li>
                            <li><a href="{{ route('lecturer.units.index') }}" class="sidebar-sublink block rounded-md py-2 pl-2 text-xs font-medium">Unit Details</a></li>
                            <li><a href="{{ route('lecturer.timetable.index') }}" class="sidebar-sublink block rounded-md py-2 pl-2 text-xs font-medium">Unit Schedule</a></li>
                            <li><a href="{{ route('lecturer.materials.index') }}" class="sidebar-sublink block rounded-md py-2 pl-2 text-xs font-medium">Teaching Materials</a></li>
                        </ul>
                    </li>
                    {{-- 3. Students --}}
                    <li x-data="{ open: {{ request()->routeIs('lecturer.students.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open" type="button" class="sidebar-link flex w-full items-center justify-between rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-users"></i></span>
                                <span>Students</span>
                            </span>
                            <span class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('lecturer.students.index') }}" class="sidebar-sublink {{ request()->routeIs('lecturer.students.index') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">By Unit</a></li>
                            <li><a href="{{ route('lecturer.students.index') }}" class="sidebar-sublink block rounded-md py-2 pl-2 text-xs font-medium">Enrollment Status</a></li>
                        </ul>
                    </li>
                    {{-- 4. Grades / Results --}}
                    <li x-data="{ open: {{ request()->routeIs('lecturer.grades.*') ? 'true' : 'false' }} }">
                        <button @click="sidebarCollapsed ? (sidebarCollapsed = false, localStorage.setItem('sidebarCollapsed', false), open = true) : (open = !open)" type="button" title="Grades / Results" class="sidebar-link flex w-full items-center rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-marker"></i></span>
                                <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Grades / Results</span>
                            </span>
                            <span x-show="!sidebarCollapsed" class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open && !sidebarCollapsed" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('lecturer.grades.index') }}" class="sidebar-sublink {{ request()->routeIs('lecturer.grades.index') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">View Results</a></li>
                            <li><a href="{{ route('lecturer.grades.index') }}" class="sidebar-sublink block rounded-md py-2 pl-2 text-xs font-medium">Upload / Edit Grades</a></li>
                            <li><a href="{{ route('lecturer.grades.index') }}" class="sidebar-sublink block rounded-md py-2 pl-2 text-xs font-medium">Performance Summary</a></li>
                        </ul>
                    </li>
                    {{-- 5. Learning Materials --}}
                    <li>
                        <a href="{{ route('lecturer.materials.index') }}" title="Learning Materials" class="sidebar-link {{ request()->routeIs('lecturer.materials.*') ? 'sidebar-link-active' : '' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors" :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                            <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-folder"></i></span>
                            <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Learning Materials</span>
                        </a>
                    </li>
                    {{-- 6. Attendance --}}
                    <li>
                        <a href="{{ route('lecturer.attendance.index') }}" title="Attendance" class="sidebar-link {{ request()->routeIs('lecturer.attendance.*') ? 'sidebar-link-active' : '' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors" :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                            <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-clipboard-list"></i></span>
                            <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Attendance</span>
                        </a>
                    </li>
                    {{-- 7. Announcements --}}
                    <li x-data="{ open: {{ request()->routeIs('lecturer.announcements.*') ? 'true' : 'false' }} }">
                        <button @click="sidebarCollapsed ? (sidebarCollapsed = false, localStorage.setItem('sidebarCollapsed', false), open = true) : (open = !open)" type="button" title="Announcements" class="sidebar-link flex w-full items-center rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-bell"></i></span>
                                <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Announcements</span>
                            </span>
                            <span x-show="!sidebarCollapsed" class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open && !sidebarCollapsed" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('lecturer.announcements.index') }}" class="sidebar-sublink {{ request()->routeIs('lecturer.announcements.index') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">View All</a></li>
                            <li><a href="{{ route('lecturer.announcements.create') }}" class="sidebar-sublink {{ request()->routeIs('lecturer.announcements.create') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Post Announcement</a></li>
                        </ul>
                    </li>
                    {{-- 8. Timetable / Schedule --}}
                    <li>
                        <a href="{{ route('lecturer.timetable.index') }}" title="Timetable" class="sidebar-link {{ request()->routeIs('lecturer.timetable.*') ? 'sidebar-link-active' : '' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors" :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                            <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-calendar-days"></i></span>
                            <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Timetable</span>
                        </a>
                    </li>
                    {{-- 9. Messages (optional) --}}
                    <li>
                        <a href="{{ route('lecturer.messages.index') }}" title="Messages" class="sidebar-link {{ request()->routeIs('lecturer.messages.*') ? 'sidebar-link-active' : '' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors" :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                            <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-comments"></i></span>
                            <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Messages</span>
                        </a>
                    </li>
                @else
                    <p x-show="!sidebarCollapsed" x-transition class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-wider text-gray-400" style="display: none;">Student</p>
                    {{-- 1. Dashboard --}}
                    <li>
                        <a href="{{ route('student.dashboard') }}" title="Dashboard" class="sidebar-link {{ request()->routeIs('student.dashboard') ? 'sidebar-link-active' : '' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors" :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                            <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-gauge-high"></i></span>
                            <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Dashboard</span>
                        </a>
                    </li>
                    {{-- 2. My Units --}}
                    <li x-data="{ open: {{ request()->routeIs('student.my-units.*') ? 'true' : 'false' }} }">
                        <button @click="sidebarCollapsed ? (sidebarCollapsed = false, localStorage.setItem('sidebarCollapsed', false), open = true) : (open = !open)" type="button" title="My Units" class="sidebar-link flex w-full items-center rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-book"></i></span>
                                <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">My Units</span>
                            </span>
                            <span x-show="!sidebarCollapsed" class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open && !sidebarCollapsed" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('student.my-units.index') }}" class="sidebar-sublink {{ request()->routeIs('student.my-units.index') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">View Registered Units</a></li>
                            <li><a href="{{ route('student.my-units.index') }}" class="sidebar-sublink block rounded-md py-2 pl-2 text-xs font-medium">Unit Schedule</a></li>
                        </ul>
                    </li>
                    {{-- 3. Unit Booking / Registration --}}
                    <li x-data="{ open: {{ request()->routeIs('student.units.*') ? 'true' : 'false' }} }">
                        <button @click="sidebarCollapsed ? (sidebarCollapsed = false, localStorage.setItem('sidebarCollapsed', false), open = true) : (open = !open)" type="button" title="Unit Booking" class="sidebar-link flex w-full items-center rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : 'justify-between'">
                            <span class="flex items-center gap-3">
                                <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-pen-to-square"></i></span>
                                <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Unit Booking</span>
                            </span>
                            <span x-show="!sidebarCollapsed" class="sidebar-chevron shrink-0 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">▼</span>
                        </button>
                        <ul x-show="open && !sidebarCollapsed" x-transition class="mt-1 space-y-0.5 border-l-2 border-gray-100 pl-4 ml-4">
                            <li><a href="{{ route('student.units.index') }}" class="sidebar-sublink {{ request()->routeIs('student.units.index') ? 'sidebar-sublink-active' : '' }} block rounded-md py-2 pl-2 text-xs font-medium">Available Units</a></li>
                            <li><a href="{{ route('student.units.index') }}" class="sidebar-sublink block rounded-md py-2 pl-2 text-xs font-medium">Registration Status</a></li>
                        </ul>
                    </li>
                    {{-- 4. Results / Grades --}}
                    <li>
                        <a href="{{ route('student.results.index') }}" title="Results / Grades" class="sidebar-link {{ request()->routeIs('student.results.*') ? 'sidebar-link-active' : '' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors" :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                            <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-chart-column"></i></span>
                            <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Results / Grades</span>
                        </a>
                    </li>
                    {{-- 5. Timetable / Schedule --}}
                    <li>
                        <a href="{{ route('student.timetable.index') }}" title="Timetable" class="sidebar-link {{ request()->routeIs('student.timetable.*') ? 'sidebar-link-active' : '' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors" :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                            <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-calendar-days"></i></span>
                            <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Timetable</span>
                        </a>
                    </li>
                    {{-- 6. Learning Materials --}}
                    <li>
                        <a href="{{ route('student.materials.index') }}" title="Learning Materials" class="sidebar-link {{ request()->routeIs('student.materials.*') ? 'sidebar-link-active' : '' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors" :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                            <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-folder"></i></span>
                            <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Learning Materials</span>
                        </a>
                    </li>
                    {{-- 7. Announcements / Updates --}}
                    <li>
                        <a href="{{ route('student.announcements.index') }}" title="Announcements" class="sidebar-link {{ request()->routeIs('student.announcements.*') ? 'sidebar-link-active' : '' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors" :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                            <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-bullhorn"></i></span>
                            <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Announcements</span>
                        </a>
                    </li>
                    {{-- 8. Messages (optional) --}}
                    <li>
                        <a href="{{ route('student.messages.index') }}" title="Messages" class="sidebar-link {{ request()->routeIs('student.messages.*') ? 'sidebar-link-active' : '' }} flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition-colors" :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                            <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs"><i class="fa-solid fa-comments"></i></span>
                            <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Messages</span>
                        </a>
                    </li>
                @endif

                {{-- Profile (bottom) --}}
                <li class="mt-auto pt-4">
                    <div class="border-t border-gray-100 pt-3">
                        <a href="{{ route('profile.edit') }}" title="Profile" class="sidebar-link flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-600 transition-colors hover:bg-gray-100 hover:text-indigo-700" :class="sidebarCollapsed ? 'justify-center px-2' : ''">
                            <span class="sidebar-icon flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gray-100 text-gray-600"><i class="fa-solid fa-user text-xs"></i></span>
                            <span x-show="!sidebarCollapsed" x-transition class="truncate" style="display: none;">Profile</span>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<style>
    /* Sidebar link states */
    .sidebar-link { color: rgb(55 65 81); }
    .sidebar-link:hover { background-color: rgb(243 244 246); color: rgb(67 56 202); }
    .sidebar-link-active { background-color: rgb(238 242 255); color: rgb(79 70 229); }
    .sidebar-link-active .sidebar-icon { background-color: rgb(224 231 255); color: rgb(79 70 229); }
    .sidebar-sublink { color: rgb(75 85 99); }
    .sidebar-sublink:hover { color: rgb(79 70 229); background-color: rgb(249 250 251); }
    .sidebar-sublink-active { color: rgb(79 70 229); font-weight: 600; background-color: rgb(238 242 255); }
    /* Slim scrollbar for sidebar nav */
    .sidebar-nav::-webkit-scrollbar { width: 6px; }
    .sidebar-nav::-webkit-scrollbar-track { background: transparent; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: rgb(209 213 219); border-radius: 3px; }
    .sidebar-nav::-webkit-scrollbar-thumb:hover { background: rgb(156 163 175); }
</style>
