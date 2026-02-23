<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">General Settings</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800">{{ session('success') }}</div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-gray-600 mb-6">System name and unit booking limits. Changes apply immediately.</p>
                <form action="{{ route('admin.settings.general.update') }}" method="post" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="app_name" class="block text-sm font-medium text-gray-700">Application name</label>
                        <input type="text" name="app_name" id="app_name" value="{{ old('app_name', $settings['app_name']) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label for="max_units_per_semester" class="block text-sm font-medium text-gray-700">Max units per semester (per student)</label>
                        <input type="number" name="max_units_per_semester" id="max_units_per_semester" value="{{ old('max_units_per_semester', $settings['max_units_per_semester']) }}" min="1" max="20" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Save</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
