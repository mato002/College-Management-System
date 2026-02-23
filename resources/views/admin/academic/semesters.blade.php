<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Academic Semesters</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800">{{ session('success') }}</div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <p class="p-4 text-gray-600 border-b border-gray-100">Set registration deadlines and current semester. Unit booking is blocked after the deadline.</p>
                <ul class="divide-y divide-gray-200">
                    @forelse($semesters as $s)
                        <li class="p-4">
                            <form action="{{ route('admin.academic.semesters.update', $s) }}" method="post" class="flex flex-wrap items-end gap-4">
                                @csrf
                                @method('PUT')
                                <div class="flex-1 min-w-[200px]">
                                    <p class="font-medium text-gray-900">{{ $s->name }} ({{ $s->slug }})</p>
                                    <p class="text-sm text-gray-500">
                                        {{ $s->start_date?->format('M j, Y') }} – {{ $s->end_date?->format('M j, Y') }}
                                    </p>
                                </div>
                                <div>
                                    <label for="reg_{{ $s->id }}" class="block text-xs font-medium text-gray-500">Registration deadline</label>
                                    <input type="datetime-local" name="registration_deadline" id="reg_{{ $s->id }}" value="{{ $s->registration_deadline?->format('Y-m-d\TH:i') }}" class="mt-1 rounded-md border-gray-300 text-sm">
                                </div>
                                <label class="flex items-center gap-2">
                                    <input type="hidden" name="is_current" value="0">
                                    <input type="checkbox" name="is_current" value="1" {{ $s->is_current ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600">
                                    <span class="text-sm text-gray-700">Current semester</span>
                                </label>
                                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-indigo-500">Save</button>
                            </form>
                        </li>
                    @empty
                        <li class="p-6 text-gray-500">No semesters. Run <code class="bg-gray-100 px-1">php artisan db:seed --class=SemesterSeeder</code></li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
