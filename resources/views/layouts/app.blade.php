<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-full bg-background text-foreground antialiased">
        <april:sidebar-layout width="16rem" width-icon="3.5rem">
            <april:sidebar collapsible="icon" class="border-r">
                <slot:header>
                    <x-app-logo :sidebar="true" class="px-2 py-1" />
                </slot:header>

                <slot:content>
                    <april:sidebar-group>
                        <april:sidebar-group-label>Workspace</april:sidebar-group-label>
                        <april:sidebar-group-content>
                            <april:sidebar-menu>
                                <april:sidebar-menu-item>
                                    <april:sidebar-menu-button-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" wire:navigate>
                                        <span class="text-xs font-bold">D</span>
                                        <span>Dashboard</span>
                                    </april:sidebar-menu-button-link>
                                </april:sidebar-menu-item>
                            </april:sidebar-menu>
                        </april:sidebar-group-content>
                    </april:sidebar-group>

                    <april:sidebar-group>
                        <april:sidebar-group-label>Account</april:sidebar-group-label>
                        <april:sidebar-group-content>
                            <april:sidebar-menu>
                                <april:sidebar-menu-item>
                                    <april:sidebar-menu-button-link href="{{ route('profile.edit') }}" :active="request()->routeIs('profile.edit')" wire:navigate>
                                        <span class="text-xs font-bold">P</span>
                                        <span>Profile</span>
                                    </april:sidebar-menu-button-link>
                                </april:sidebar-menu-item>
                                <april:sidebar-menu-item>
                                    <april:sidebar-menu-button-link href="{{ route('security.edit') }}" :active="request()->routeIs('security.edit')" wire:navigate>
                                        <span class="text-xs font-bold">S</span>
                                        <span>Security</span>
                                    </april:sidebar-menu-button-link>
                                </april:sidebar-menu-item>
                                <april:sidebar-menu-item>
                                    <april:sidebar-menu-button-link href="{{ route('appearance.edit') }}" :active="request()->routeIs('appearance.edit')" wire:navigate>
                                        <span class="text-xs font-bold">A</span>
                                        <span>Appearance</span>
                                    </april:sidebar-menu-button-link>
                                </april:sidebar-menu-item>
                            </april:sidebar-menu>
                        </april:sidebar-group-content>
                    </april:sidebar-group>
                </slot:content>

                <slot:footer>
                    <div class="flex items-center gap-2 px-2 py-2 group-data-[collapsible=icon]:justify-center">
                        <april:avatar size="sm">
                            <slot:fallback>{{ auth()->user()->initials() }}</slot:fallback>
                        </april:avatar>
                        <div class="min-w-0 group-data-[collapsible=icon]:hidden">
                            <p class="truncate text-sm font-medium">{{ auth()->user()->name }}</p>
                            <p class="truncate text-xs text-muted-foreground">{{ auth()->user()->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="ml-auto group-data-[collapsible=icon]:hidden">
                            @csrf
                            <april:button type="submit" variant="ghost" size="icon" aria-label="Log out">
                                <span class="text-xs">↗</span>
                            </april:button>
                        </form>
                    </div>
                </slot:footer>

                <april:sidebar-rail />
            </april:sidebar>

            <april:sidebar-inset>
                <header class="flex h-14 items-center gap-3 border-b px-4 lg:px-6">
                    <april:sidebar-trigger />
                    <h1 class="text-sm font-medium">{{ $title ?? 'Dashboard' }}</h1>
                </header>
                <main class="p-4 lg:p-6">
                    {{ $slot }}
                </main>
            </april:sidebar-inset>
        </april:sidebar-layout>

        @aprilScripts
        @livewireScripts
    </body>
</html>
