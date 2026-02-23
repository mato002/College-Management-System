<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post announcement</h2>
            <a href="{{ route('lecturer.announcements.index') }}" class="text-sm font-medium text-indigo-600 hover:underline">Back</a>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <form method="post" action="{{ route('lecturer.announcements.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm">
                    <x-input-error :messages="$errors->get('title')" class="mt-1" />
                </div>
                <div>
                    <label for="body" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea id="body" name="body" rows="5" required class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm">{{ old('body') }}</textarea>
                    <x-input-error :messages="$errors->get('body')" class="mt-1" />
                </div>
                <div>
                    <label for="unit_id" class="block text-sm font-medium text-gray-700">Unit (optional)</label>
                    <select id="unit_id" name="unit_id" class="mt-1 block w-full rounded-lg border border-gray-300 shadow-sm">
                        <option value="">Global</option>
                        @foreach($units as $u)
                            <option value="{{ $u->id }}" {{ old('unit_id') == $u->id ? 'selected' : '' }}>{{ $u->code }} — {{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Post</button>
                    <a href="{{ route('lecturer.announcements.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
