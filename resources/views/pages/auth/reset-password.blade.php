<x-layouts::auth :title="__('Reset password')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Reset password')" :description="__('Please enter your new password below')" />
        <x-auth-session-status class="text-center" :status="session('status')" />
        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-5">
            @csrf
            <input type="hidden" name="token" value="{{ request()->route('token') }}">
            <x-form-field name="email" :label="__('Email')" :value="request('email')" type="email" required autocomplete="email" />
            <x-form-field name="password" :label="__('Password')" type="password" required autocomplete="new-password" />
            <x-form-field name="password_confirmation" :label="__('Confirm password')" type="password" required autocomplete="new-password" />
            <april:button type="submit" class="w-full" data-test="reset-password-button">{{ __('Reset password') }}</april:button>
        </form>
    </div>
</x-layouts::auth>
