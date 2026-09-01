<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component {
    public string $password = '';

    public function deleteUser(): void
    {
        $this->validate(['password' => ['required', 'string', 'current_password']]);

        $user = Auth::user();
        Auth::logout();
        $user->delete();
        $this->redirect('/');
    }
}; ?>

<april:dialog x-teleport="body" dismissable>
    <slot:trigger>
        <april:button variant="destructive" data-test="delete-user-button">{{ __('Delete account') }}</april:button>
    </slot:trigger>
    <slot:content>
        <april:dialog-header>
            <slot:title>{{ __('Are you sure you want to delete your account?') }}</slot:title>
            <slot:description>{{ __('This action cannot be undone. Your account and all related data will be permanently removed.') }}</slot:description>
        </april:dialog-header>
        <form wire:submit="deleteUser" class="mt-6 space-y-5">
            <x-form-field name="password" :label="__('Password')" wire:model="password" type="password" required autocomplete="current-password" />
            <april:dialog-footer>
                <slot:close><april:button type="button" variant="outline" x-on:click="close()">{{ __('Cancel') }}</april:button></slot:close>
                <april:button variant="destructive" type="submit" data-test="confirm-delete-user-button">{{ __('Delete account') }}</april:button>
            </april:dialog-footer>
        </form>
    </slot:content>
</april:dialog>
