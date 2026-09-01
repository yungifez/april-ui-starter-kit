<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-full bg-muted/30 text-foreground antialiased">
        <main class="flex min-h-svh flex-col items-center justify-center gap-8 px-6 py-10">
            <x-app-logo href="{{ route('home') }}" wire:navigate />
            <div class="w-full max-w-md rounded-xl border bg-card p-6 shadow-sm sm:p-8">
                {{ $slot }}
            </div>
        </main>

        @aprilScripts
        @livewireScripts
    </body>
</html>
