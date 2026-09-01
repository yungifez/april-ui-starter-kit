<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Appearance settings')] class extends Component {
    // Appearance is stored in localStorage so it follows the browser across sessions.
}; ?>

<section class="w-full">
    @include('partials.settings-heading')
    <x-pages::settings.layout :heading="__('Appearance')" :subheading="__('Choose the theme used by this application')">
        <div
            x-data="{
                appearance: window.aprilAppearance?.getStoredAppearance() || 'system',
                select(value) {
                    this.appearance = value
                    window.aprilAppearance?.updateAppearance(value)
                },
            }"
            x-on:livewire:navigated.window="appearance = window.aprilAppearance?.getStoredAppearance() || appearance"
            class="inline-flex gap-1 rounded-lg bg-neutral-100 p-1 dark:bg-neutral-800"
        >
            @foreach (['light' => 'sun', 'dark' => 'moon', 'system' => 'monitor'] as $value => $icon)
                <button
                    type="button"
                    data-appearance-control="{{ $value }}"
                    x-on:click="select('{{ $value }}')"
                    x-bind:aria-pressed="appearance === '{{ $value }}'"
                    x-bind:class="appearance === '{{ $value }}' ? 'bg-white shadow-xs dark:bg-neutral-700 dark:text-neutral-100' : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60'"
                    class="flex items-center rounded-md px-3.5 py-1.5 transition-colors"
                >
                    @if ($icon === 'sun')
                        <x-lucide-sun class="size-4" />
                    @elseif ($icon === 'moon')
                        <x-lucide-moon class="size-4" />
                    @else
                        <x-lucide-monitor class="size-4" />
                    @endif
                    <span class="ml-1.5 text-sm">{{ __(ucfirst($value)) }}</span>
                </button>
            @endforeach
        </div>
    </x-pages::settings.layout>
</section>
