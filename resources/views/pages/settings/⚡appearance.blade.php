<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Appearance settings')] class extends Component {
    // Appearance is stored in localStorage so it follows the browser across sessions.
}; ?>

<section class="w-full">
    @include('partials.settings-heading')
    <x-pages::settings.layout :heading="__('Appearance')" :subheading="__('Choose the theme used by this application')">
        <div x-data="{
            theme: localStorage.getItem('theme') || 'system',
            setTheme(value) {
                this.theme = value
                localStorage.setItem('theme', value)
                const dark = value === 'dark' || (value === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)
                document.documentElement.classList.toggle('dark', dark)
            }
        }" class="grid gap-3 sm:grid-cols-3">
            @foreach (['light' => 'sun', 'dark' => 'moon', 'system' => 'monitor'] as $value => $icon)
                <april:button type="button" variant="outline" class="justify-start gap-2" ::class="theme === '{{ $value }}' ? 'border-primary ring-2 ring-ring' : ''" @click="setTheme('{{ $value }}')">
                    @if ($icon === 'sun') <x-lucide-sun class="size-4" /> @elseif ($icon === 'moon') <x-lucide-moon class="size-4" /> @else <x-lucide-monitor class="size-4" /> @endif
                    {{ __(ucfirst($value)) }}
                </april:button>
            @endforeach
        </div>
    </x-pages::settings.layout>
</section>
