<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Activity Log</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($logs as $log)
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $log->created_at->format('M j, Y H:i') }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $log->user?->name ?? '—' }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $log->action }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $log->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">No activity yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-4 py-3 border-t border-gray-100">{{ $logs->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
