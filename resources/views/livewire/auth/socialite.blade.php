<div class="mt-5">
    <div class="relative">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-sm font-medium leading-6">
            <span class="px-6 text-gray-900 dark:text-gray-200 dark:bg-gray-800">Or continue with</span>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-2 gap-4">
        @foreach($enabled_oauth_providers as $enabled_oauth_provider)
        <x-secondary-button x-on:click="document.location.href='{{ route('auth.redirect', [
            'provider' => $enabled_oauth_provider->provider
        ]) }}'">
            {{ $enabled_oauth_provider->provider }}
        </x-secondary-button>
        @endforeach
    </div>
</div>