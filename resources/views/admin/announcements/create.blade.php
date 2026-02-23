<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Announcement</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="post" action="{{ route('admin.announcements.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="body" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="body" id="body" rows="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('body') }}</textarea>
                            @error('body')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="scope" class="block text-sm font-medium text-gray-700">Scope</label>
                            <select name="scope" id="scope" class="mt-1 block w-full rounded-md border-gray-300" onchange="document.getElementById('unit_id_group').style.display = this.value === 'unit' ? 'block' : 'none'">
                                <option value="global" {{ old('scope', 'global') === 'global' ? 'selected' : '' }}>Global (all users)</option>
                                <option value="unit" {{ old('scope') === 'unit' ? 'selected' : '' }}>Unit-specific</option>
                            </select>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type (for global scope)</label>
                            <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300">
                                <option value="news" {{ old('type', 'news') === 'news' ? 'selected' : '' }}>News & Updates</option>
                                <option value="notice" {{ old('type') === 'notice' ? 'selected' : '' }}>Notice / Announcement</option>
                            </select>
                            <p class="mt-1 text-xs text-gray-500">News appears in "News & Updates"; Notices in "Notices and Announcements".</p>
                        </div>
                        <div id="unit_id_group" style="display: {{ old('scope') === 'unit' ? 'block' : 'none' }}">
                            <label for="unit_id" class="block text-sm font-medium text-gray-700">Unit</label>
                            <select name="unit_id" id="unit_id" class="mt-1 block w-full rounded-md border-gray-300">
                                <option value="">Select unit</option>
                                @foreach($units as $u)
                                    <option value="{{ $u->id }}" {{ old('unit_id') == $u->id ? 'selected' : '' }}>{{ $u->code }} - {{ $u->name }}</option>
                                @endforeach
                            </select>
                            @error('unit_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm text-white hover:bg-indigo-500">Create</button>
                            <a href="{{ route('admin.announcements.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
