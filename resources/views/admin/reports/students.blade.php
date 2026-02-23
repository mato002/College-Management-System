<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Student Reports</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-900 mb-4">Overview</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $total }} total students</p>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-900 mb-4">By Status</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50"><tr><th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th><th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Count</th></tr></thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($byStatus as $row)
                            <tr><td class="px-4 py-2">{{ $row->status }}</td><td class="px-4 py-2 text-right">{{ $row->total }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="font-medium text-gray-900 mb-4">By Year of Study</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50"><tr><th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Year</th><th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Count</th></tr></thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($byYear as $row)
                            <tr><td class="px-4 py-2">Year {{ $row->year_of_study }}</td><td class="px-4 py-2 text-right">{{ $row->total }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
