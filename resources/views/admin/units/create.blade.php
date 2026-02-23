<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Unit</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="post" action="{{ route('admin.units.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="code" value="Unit Code" />
                            <x-text-input id="code" name="code" class="block mt-1 w-full" value="{{ old('code') }}" required />
                            <x-input-error :messages="$errors->get('code')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="name" value="Unit Name" />
                            <x-text-input id="name" name="name" class="block mt-1 w-full" value="{{ old('name') }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>
                        <div>
                            <x-input-label for="description" value="Description" />
                            <textarea id="description" name="description" rows="3" class="block mt-1 w-full rounded-md border border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                        </div>
                        <div>
                            <x-input-label for="semester" value="Semester (e.g. semester_1)" />
                            <x-text-input id="semester" name="semester" class="block mt-1 w-full" value="{{ old('semester') }}" />
                        </div>
                        <div>
                            <x-input-label for="capacity" value="Capacity (0 = unlimited)" />
                            <x-text-input id="capacity" name="capacity" type="number" min="0" class="block mt-1 w-full" value="{{ old('capacity', 0) }}" />
                        </div>
                        <div>
                            <x-input-label for="credits" value="Credits" />
                            <x-text-input id="credits" name="credits" type="number" min="1" class="block mt-1 w-full" value="{{ old('credits', 3) }}" />
                        </div>
                        <div>
                            <x-input-label for="status" value="Status" />
                            <select id="status" name="status" class="block mt-1 w-full rounded-md border border-gray-300 shadow-sm">
                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex gap-2">
                        <x-primary-button>Create Unit</x-primary-button>
                        <a href="{{ route('admin.units.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-sm">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
