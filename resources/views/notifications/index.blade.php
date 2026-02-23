<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Notifications</h2>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <form action="{{ route('notifications.read-all') }}" method="post" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-indigo-600 hover:underline">Mark all as read</button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if($notifications->count())
                <ul class="space-y-2">
                    @foreach($notifications as $n)
                        <li class="bg-white rounded-lg border border-gray-100 p-4 {{ $n->read_at ? 'opacity-75' : '' }}">
                            <div class="flex justify-between items-start gap-2">
                                <div>
                                    <p class="text-sm text-gray-800">{{ $n->data['message'] ?? 'Notification' }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $n->created_at->diffForHumans() }}</p>
                                    @if(!empty($n->data['action_url']))
                                        <a href="{{ $n->data['action_url'] }}" class="text-xs text-indigo-600 hover:underline mt-1 inline-block">View</a>
                                    @endif
                                </div>
                                @if(!$n->read_at)
                                    <form action="{{ route('notifications.read', $n->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="text-xs text-gray-500 hover:underline">Mark read</button>
                                    </form>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-4">{{ $notifications->links() }}</div>
            @else
                <p class="text-gray-500 text-center py-8">No notifications yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>
