<x-layouts::auth :title="__('Confirm password')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Confirm password')" :description="__('This is a secure area of the application. Please confirm your password before continuing.')" />
        <x-auth-session-status class="text-center" :status="session('status')" />
        <form method="POST" action="{{ route('password.confirm.store') }}" class="flex flex-col gap-5">
            @csrf
            <x-form-field name="password" :label="__('Password')" type="password" required autocomplete="current-password" />
            <april:button type="submit" class="w-full" data-test="confirm-password-button">{{ __('Confirm') }}</april:button>
        </form>
    </div>
</x-layouts::auth>
