<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Role: {{ $role->name }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div class="mb-4 rounded-md bg-red-50 p-4 text-red-800">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.roles.update', $role) }}" method="post" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6 space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    @if(!$role->is_system)
                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700">Slug (unique key)</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $role->slug) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Dashboard type</label>
                            <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="admin" {{ old('type', $role->type) === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="lecturer" {{ old('type', $role->type) === 'lecturer' ? 'selected' : '' }}>Lecturer</option>
                                <option value="student" {{ old('type', $role->type) === 'student' ? 'selected' : '' }}>Student</option>
                            </select>
                        </div>
                    @endif
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" name="description" id="description" value="{{ old('description', $role->description) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg border border-gray-100 p-6">
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Feature access (permissions)</h3>
                    <p class="text-xs text-gray-500 mb-4">Select which actions this role can perform.</p>
                    <div class="space-y-4">
                        @foreach($permissions as $group => $items)
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">{{ $group ?: 'General' }}</p>
                                <div class="flex flex-wrap gap-x-6 gap-y-2">
                                    @foreach($items as $perm)
                                        <label class="inline-flex items-center gap-2">
                                            <input type="checkbox" name="permissions[]" value="{{ $perm->id }}" {{ $role->permissions->contains('id', $perm->id) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600">
                                            <span class="text-sm text-gray-700">{{ $perm->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('admin.roles.index') }}" class="rounded-md bg-gray-200 px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-300">Cancel</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">Save role</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
