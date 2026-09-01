<div class="flex items-start gap-8 max-md:flex-col">
    <nav class="flex w-full gap-1 overflow-x-auto md:w-48 md:shrink-0 md:flex-col" aria-label="{{ __('Settings') }}">
        @foreach ([['profile.edit', 'Profile'], ['security.edit', 'Security'], ['appearance.edit', 'Appearance']] as [$route, $label])
            <a href="{{ route($route) }}" wire:navigate class="whitespace-nowrap rounded-md px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs($route) ? 'bg-accent text-accent-foreground' : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground' }}">{{ __($label) }}</a>
        @endforeach
    </nav>

    <april:separator class="md:hidden" />

    <div class="min-w-0 flex-1 self-stretch">
        <h2 class="text-xl font-semibold tracking-tight">{{ $heading ?? '' }}</h2>
        <p class="mt-1 text-sm text-muted-foreground">{{ $subheading ?? '' }}</p>
        <div class="mt-6 w-full max-w-lg">{{ $slot }}</div>
    </div>
</div>
