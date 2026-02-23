<header class="sticky top-0 z-30 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:px-6 lg:px-8">
    {{-- Mobile sidebar toggle --}}
    <button type="button" @click="sidebarOpen = !sidebarOpen" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" aria-label="Toggle menu">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>

    {{-- Left: back to site + page context --}}
    <div class="hidden flex-1 items-center gap-4 sm:flex">
        <a href="{{ url('/') }}" class="flex items-center gap-1.5 rounded-lg px-2.5 py-1.5 text-sm text-gray-500 transition hover:bg-gray-100 hover:text-gray-700" title="Back to website">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Site</span>
        </a>
        <span class="hidden h-4 w-px bg-gray-200 lg:block" aria-hidden="true"></span>
        <p class="hidden truncate text-sm font-medium text-gray-700 lg:block">{{ config('app.name') }} Portal</p>
    </div>

    {{-- Right: search, notifications, user --}}
    <div class="flex items-center justify-end gap-x-2 sm:gap-x-4">
        <form method="GET" action="{{ route('search') }}" class="hidden max-w-xs flex-1 items-center rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 sm:max-w-sm md:flex">
            <svg class="h-4 w-4 shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input
                type="search"
                name="q"
                value="{{ request('q') }}"
                placeholder="Search students, lecturers, units..."
                class="ml-2 block w-full border-none bg-transparent text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-0"
            />
        </form>
        <a href="{{ route('notifications.index') }}" class="relative rounded-full p-2 text-gray-500 hover:bg-gray-100" title="Notifications">
            <i class="fa-solid fa-bell text-lg text-gray-500"></i>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="absolute -top-0.5 -right-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-indigo-600 text-[10px] font-medium text-white">{{ auth()->user()->unreadNotifications->count() > 9 ? '9+' : auth()->user()->unreadNotifications->count() }}</span>
            @endif
        </a>
        <span class="hidden text-sm text-gray-500 sm:inline">{{ auth()->user()->roleLabel() }}</span>
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button type="button" class="flex items-center gap-x-2 rounded-full bg-gray-100 py-1.5 pl-2 pr-3 text-sm font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-indigo-600 text-sm font-medium text-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                    <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
            </x-slot>
            <x-slot name="content">
                <div class="px-4 py-3 text-sm text-gray-700">
                    <p class="font-medium">{{ auth()->user()->name }}</p>
                    <p class="truncate text-gray-500">{{ auth()->user()->email }}</p>
                    @if(auth()->user()->student)
                        <p class="mt-1 text-xs text-gray-500">Reg: {{ auth()->user()->student->reg_no }}</p>
                    @elseif(auth()->user()->lecturer)
                        <p class="mt-1 text-xs text-gray-500">{{ auth()->user()->lecturer->employee_id }}</p>
                    @endif
                </div>
                <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
