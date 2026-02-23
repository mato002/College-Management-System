<footer class="mt-auto border-t border-gray-200 bg-white py-4">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center justify-between gap-2 sm:flex-row">
            <p class="text-sm text-gray-500">
                <a href="https://mathiasodhiambo.netlify.app/" target="_blank" rel="noopener noreferrer" class="hover:text-indigo-600 hover:underline">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </a>
            </p>
            <p class="text-xs text-gray-400">
                {{ auth()->user()->role->label() }} portal
            </p>
        </div>
    </div>
</footer>
