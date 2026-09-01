<x-layouts::auth :title="__('Forgot password')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Forgot password')" :description="__('Enter your email to receive a password reset link')" />
        <x-auth-session-status class="text-center" :status="session('status')" />
        <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-5">
            @csrf
            <x-form-field name="email" :label="__('Email address')" type="email" required autofocus placeholder="email@example.com" />
            <april:button type="submit" class="w-full" data-test="email-password-reset-link-button">{{ __('Email password reset link') }}</april:button>
        </form>
        <p class="text-center text-sm text-muted-foreground">
            {{ __('Or, return to') }}
            <a class="text-primary underline-offset-4 hover:underline" href="{{ route('login') }}">{{ __('log in') }}</a>
        </p>
    </div>
</x-layouts::auth>
