<?php

use App\Concerns\ProfileValidationRules;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Profile settings')] class extends Component {
    use ProfileValidationRules;

    public string $name = '';
    public string $email = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();
        $validated = $this->validate($this->profileRules($user->id));

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        Session::flash('status', __('Profile updated.'));
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }

    #[Computed]
    public function hasUnverifiedEmail(): bool
    {
        return Auth::user() instanceof MustVerifyEmail && ! Auth::user()->hasVerifiedEmail();
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')
    <x-pages::settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="space-y-5">
            <x-form-field name="name" :label="__('Name')" wire:model="name" required autofocus autocomplete="name" />
            <div>
                <x-form-field name="email" :label="__('Email')" wire:model="email" type="email" required autocomplete="email" />
                @if ($this->hasUnverifiedEmail)
                    <p class="mt-3 text-sm text-muted-foreground">
                        {{ __('Your email address is unverified.') }}
                        <button type="button" wire:click="resendVerificationNotification" class="text-primary underline-offset-4 hover:underline">{{ __('Resend verification email') }}</button>
                    </p>
                @endif
            </div>
            <div class="flex items-center gap-3">
                <april:button type="submit" data-test="update-profile-button">{{ __('Save') }}</april:button>
                @if (session('status') === 'Profile updated.')
                    <span class="text-sm text-green-600">{{ __('Saved.') }}</span>
                @endif
            </div>
        </form>
    </x-pages::settings.layout>
    <div class="mx-auto mt-8 w-full max-w-lg">
        <livewire:pages::settings.delete-user-modal />
    </div>
</section>
