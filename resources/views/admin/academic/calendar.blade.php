<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Academic Calendar</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-600 mb-4">Semester dates and registration deadlines. Manage deadlines in <a href="{{ route('admin.academic.semesters') }}" class="text-indigo-600 hover:underline">Semesters</a>.</p>
                <div class="space-y-3">
                    @forelse($semesters as $s)
                        <div class="flex flex-wrap items-center gap-4 py-2 border-b border-gray-100 last:border-0">
                            <span class="font-medium text-gray-900">{{ $s->name }}</span>
                            @if($s->is_current)<span class="rounded bg-indigo-100 px-2 py-0.5 text-xs font-medium text-indigo-700">Current</span>@endif
                            <span class="text-sm text-gray-500">{{ $s->start_date?->format('M j, Y') }} – {{ $s->end_date?->format('M j, Y') }}</span>
                            <span class="text-sm text-gray-600">Registration closes: {{ $s->registration_deadline ? $s->registration_deadline->format('M j, Y H:i') : 'Not set' }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500">No semesters. Run <code class="bg-gray-100 px-1">php artisan db:seed --class=SemesterSeeder</code></p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
