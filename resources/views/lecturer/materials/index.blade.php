<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Learning Materials</h2>
    </x-slot>

    <div class="space-y-6">
        <p class="text-sm text-gray-600">Upload notes, assignments, and manage resources per unit. (File storage can be added later.)</p>

        @if($units->count())
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($units as $u)
                    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
                        <h3 class="font-semibold text-gray-900">{{ $u->code }} — {{ $u->name }}</h3>
                        <ul class="mt-3 space-y-2 text-sm text-gray-600">
                            <li>· Upload notes</li>
                            <li>· Upload assignments</li>
                            <li>· Manage resources</li>
                        </ul>
                        <p class="mt-3 text-xs text-gray-400">File upload UI can be wired here.</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-xl border border-gray-200 bg-white p-8 text-center text-gray-500">
                No units assigned. You need assigned units to add materials.
            </div>
        @endif
    </div>
</x-app-layout>
