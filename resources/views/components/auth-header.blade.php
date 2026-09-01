@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-center">
    <h1 class="text-2xl font-semibold tracking-tight">{{ $title }}</h1>
    <p class="mt-2 text-sm text-muted-foreground">{{ $description }}</p>
</div>
