<x-layouts::auth :title="__('Register')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-5">
            @csrf
            <x-form-field name="name" :label="__('Name')" :value="old('name')" required autofocus autocomplete="name" placeholder="{{ __('Full name') }}" />
            <x-form-field name="email" :label="__('Email address')" :value="old('email')" type="email" required autocomplete="email" placeholder="email@example.com" />
            <x-form-field name="password" :label="__('Password')" type="password" required autocomplete="new-password" />
            <x-form-field name="password_confirmation" :label="__('Confirm password')" type="password" required autocomplete="new-password" />
            <april:button type="submit" class="w-full" data-test="register-user-button">{{ __('Create account') }}</april:button>
        </form>

        <p class="text-center text-sm text-muted-foreground">
            {{ __('Already have an account?') }}
            <a class="text-primary underline-offset-4 hover:underline" href="{{ route('login') }}">{{ __('Log in') }}</a>
        </p>
    </div>
</x-layouts::auth>
