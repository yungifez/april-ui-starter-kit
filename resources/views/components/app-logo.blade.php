<a href="{{ $attributes->get('href', route('dashboard')) }}" {{ $attributes->except('href')->twMerge(['flex items-center gap-2 font-semibold no-underline']) }}>
    <span class="flex size-8 shrink-0 items-center justify-center rounded-md bg-primary text-primary-foreground">
        <x-app-logo-icon class="size-5 fill-current" />
    </span>
    <span class="truncate group-data-[collapsible=icon]:hidden">{{ config('app.name', 'Laravel') }}</span>
</a>
