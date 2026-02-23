@props(['items' => []])

<nav aria-label="Breadcrumb" class="mb-6 text-sm">
    <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-gray-600">
        <li><a href="{{ url('/') }}" class="text-primary hover:underline focus-ring rounded px-1 py-0.5">Home</a></li>
        @foreach($items as $item)
        <li class="flex items-center gap-x-2">
            <span aria-hidden="true" class="text-gray-400">/</span>
            @if(!empty($item['url']))
            <a href="{{ $item['url'] }}" class="text-primary hover:underline focus-ring rounded px-1 py-0.5">{{ $item['label'] }}</a>
            @else
            <span class="font-medium text-gray-900">{{ $item['label'] }}</span>
            @endif
        </li>
        @endforeach
    </ol>
</nav>
