<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-full bg-background text-foreground antialiased">
        <header class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-8">
            <x-app-logo href="{{ route('home') }}" />
            <nav class="flex items-center gap-2">
                @auth
                    <april:button-link href="{{ route('dashboard') }}" wire:navigate>Dashboard</april:button-link>
                @else
                    <a class="rounded-md px-3 py-2 text-sm text-muted-foreground hover:bg-accent hover:text-accent-foreground" href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <april:button-link href="{{ route('register') }}">Get started</april:button-link>
                    @endif
                @endauth
            </nav>
        </header>

        <main class="mx-auto max-w-7xl px-6 pb-20 pt-16 lg:px-8 lg:pt-24">
            <div class="max-w-3xl">
                <april:badge variant="secondary">Laravel starter kit</april:badge>
                <h1 class="mt-6 text-4xl font-semibold tracking-tight sm:text-6xl">Build your next product with April UI.</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-muted-foreground">A clean Laravel 13 foundation with Livewire 4, Fortify authentication, and April UI components that keep the Laravel way of working intact.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    @auth
                        <april:button-link href="{{ route('dashboard') }}" size="lg" wire:navigate>Open dashboard</april:button-link>
                    @else
                        <april:button-link href="{{ route('register') }}" size="lg">Create an account</april:button-link>
                        <april:button-link href="{{ route('login') }}" variant="outline" size="lg">Log in</april:button-link>
                    @endauth
                </div>
            </div>

            <div class="mt-20 grid gap-4 md:grid-cols-3">
                @foreach ([['Native Laravel', 'Use routes, middleware, policies, migrations, and vendor publishing as you already do.'], ['Livewire ready', 'Build interactive pages with Livewire 4 and keep server-side behaviour close to your templates.'], ['April UI included', 'Start with accessible, composable Blade components and customize their published views when needed.']] as [$title, $description])
                    <april:card>
                        <slot:title>{{ $title }}</slot:title>
                        <slot:content><p class="text-sm leading-6 text-muted-foreground">{{ $description }}</p></slot:content>
                    </april:card>
                @endforeach
            </div>
        </main>
        @aprilScripts
        @livewireScripts
    </body>
</html>
