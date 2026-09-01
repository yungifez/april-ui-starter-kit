<?php

use App\Concerns\PasswordValidationRules;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Security settings')] class extends Component {
    use PasswordValidationRules;

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        $validated = $this->validate([
            'current_password' => $this->currentPasswordRules(),
            'password' => $this->passwordRules(),
        ]);

        Auth::user()->update(['password' => $validated['password']]);
        $this->reset('current_password', 'password', 'password_confirmation');
        session()->flash('status', __('Password updated.'));
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')
    <x-pages::settings.layout :heading="__('Security')" :subheading="__('Update your password and keep your account secure')">
        <form wire:submit="updatePassword" class="space-y-5">
            <x-form-field name="current_password" :label="__('Current password')" wire:model="current_password" type="password" required autocomplete="current-password" />
            <x-form-field name="password" :label="__('New password')" wire:model="password" type="password" required autocomplete="new-password" />
            <x-form-field name="password_confirmation" :label="__('Confirm new password')" wire:model="password_confirmation" type="password" required autocomplete="new-password" />
            <div class="flex items-center gap-3">
                <april:button type="submit">{{ __('Update password') }}</april:button>
                @if (session('status') === 'Password updated.')
                    <span class="text-sm text-green-600">{{ __('Saved.') }}</span>
                @endif
            </div>
        </form>
    </x-pages::settings.layout>
</section>
