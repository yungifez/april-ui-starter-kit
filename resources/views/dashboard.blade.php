<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-sidebar-border/70 dark:stroke-sidebar-border" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-sidebar-border/70 dark:stroke-sidebar-border" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-sidebar-border/70 dark:stroke-sidebar-border" />
            </div>
        </div>
        <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-sidebar-border/70 dark:stroke-sidebar-border" />
        </div>
    </div>
</x-layouts::app>
