<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles & Permissions</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-green-800">{{ session('success') }}</div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Permissions</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Users</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($roles as $role)
                            <tr>
                                <td class="px-4 py-3">
                                    <span class="font-medium text-gray-900">{{ $role->name }}</span>
                                    @if($role->is_system)
                                        <span class="ml-1 text-xs text-gray-400">(system)</span>
                                    @endif
                                    @if($role->description)
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $role->description }}</p>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ ucfirst($role->type) }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $role->permissions_count }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $role->users_count }}</td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="text-indigo-600 hover:underline font-medium">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <p class="mt-4 text-sm text-gray-500">Assign permissions to roles. Admin-type roles access the admin panel. Assign roles to users when editing users.</p>
        </div>
    </div>
</x-app-layout>
