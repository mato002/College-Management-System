@props(['title' => 'Nothing here yet', 'message' => 'Check back later for updates.', 'icon' => 'document'])

<div class="rounded-2xl border border-gray-100 bg-white p-12 text-center shadow-sm">
    @if($icon === 'document')
    <svg class="mx-auto h-14 w-14 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
    @elseif($icon === 'newspaper')
    <svg class="mx-auto h-14 w-14 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6m4-4h-1.5M9 4h-1.5"/></svg>
    @elseif($icon === 'calendar')
    <svg class="mx-auto h-14 w-14 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
    @else
    <svg class="mx-auto h-14 w-14 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.5m-2.5 0h-5M15 10h.01M9 10h.01M4.5 10h.01"/></svg>
    @endif
    <h3 class="mt-4 font-fraunces text-lg font-semibold text-gray-900">{{ $title }}</h3>
    <p class="mx-auto mt-2 max-w-sm text-gray-500">{{ $message }}</p>
    {{ $slot ?? '' }}
</div>
