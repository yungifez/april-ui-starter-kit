<x-layouts::app :title="__('Dashboard')">
    <div class="mx-auto max-w-7xl space-y-6">
        <div>
            <p class="text-sm text-muted-foreground">{{ now()->format('l, F j, Y') }}</p>
            <h2 class="mt-1 text-2xl font-semibold tracking-tight">{{ __('Welcome back, :name', ['name' => auth()->user()->name]) }}</h2>
            <p class="mt-1 text-muted-foreground">{{ __('Here is a quick overview of your workspace.') }}</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ([['Projects', '12', '+2 this month'], ['Tasks completed', '84%', '+8.2% from last month'], ['Team members', '24', '+3 this month'], ['Deployments', '18', 'All systems operational']] as [$label, $value, $detail])
                <april:card>
                    <slot:title class="text-sm font-medium">{{ $label }}</slot:title>
                    <slot:content>
                        <div class="text-2xl font-bold">{{ $value }}</div>
                        <p class="mt-1 text-xs text-muted-foreground">{{ $detail }}</p>
                    </slot:content>
                </april:card>
            @endforeach
        </div>

        <div class="grid gap-6 lg:grid-cols-5">
            <april:card class="lg:col-span-3">
                <slot:title>Recent activity</slot:title>
                <slot:description>Latest changes across your workspace.</slot:description>
                <slot:content>
                    <div class="divide-y divide-border">
                        @foreach ([['Maya Chen', 'Updated the marketing site', '2 minutes ago', 'MC'], ['Jordan Lee', 'Deployed version 2.4.0', '1 hour ago', 'JL'], ['Sam Rivera', 'Created a new project', 'Yesterday', 'SR']] as [$name, $activity, $time, $initials])
                            <div class="flex items-center gap-3 py-4 first:pt-0 last:pb-0">
                                <april:avatar size="sm"><slot:fallback>{{ $initials }}</slot:fallback></april:avatar>
                                <div class="min-w-0 flex-1"><p class="text-sm font-medium">{{ $name }}</p><p class="truncate text-sm text-muted-foreground">{{ $activity }}</p></div>
                                <span class="text-xs text-muted-foreground">{{ $time }}</span>
                            </div>
                        @endforeach
                    </div>
                </slot:content>
            </april:card>

            <april:card class="lg:col-span-2">
                <slot:title>Next steps</slot:title>
                <slot:description>Finish setting up your workspace.</slot:description>
                <slot:content>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3"><span class="flex size-7 items-center justify-center rounded-full bg-primary text-xs font-medium text-primary-foreground">1</span><span class="text-sm">Invite your team</span><april:badge class="ml-auto" variant="secondary">Ready</april:badge></div>
                        <div class="flex items-center gap-3"><span class="flex size-7 items-center justify-center rounded-full border text-xs font-medium">2</span><span class="text-sm">Connect a repository</span><april:badge class="ml-auto" variant="outline">Pending</april:badge></div>
                        <div class="flex items-center gap-3"><span class="flex size-7 items-center justify-center rounded-full border text-xs font-medium">3</span><span class="text-sm">Configure notifications</span><april:badge class="ml-auto" variant="outline">Pending</april:badge></div>
                    </div>
                </slot:content>
            </april:card>
        </div>
    </div>
</x-layouts::app>
