<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Attendance Management</h2>
    </x-slot>

    <div class="space-y-6">
        <p class="text-sm text-gray-600">Mark attendance and view attendance records per unit. (Attendance table can be added when needed.)</p>

        @if($units->count())
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach($units as $u)
                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                        <h3 class="font-semibold text-gray-900">{{ $u->code }} — {{ $u->name }}</h3>
                        <ul class="mt-3 space-y-1 text-sm text-gray-600">
                            <li>· Mark attendance</li>
                            <li>· View attendance records</li>
                            <li>· Attendance reports</li>
                        </ul>
                        <p class="mt-3 text-xs text-gray-400">Attendance feature can be wired to an attendance table.</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-xl border border-gray-200 bg-white p-8 text-center text-gray-500">
                No units assigned. Assign units to manage attendance.
            </div>
        @endif
    </div>
</x-app-layout>
