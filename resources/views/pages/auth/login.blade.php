<x-layouts::auth :title="__('Log in')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf
            <x-form-field name="email" :label="__('Email address')" :value="old('email')" type="email" required autofocus autocomplete="email" placeholder="email@example.com" />
            <div class="relative">
                <x-form-field name="password" :label="__('Password')" type="password" required autocomplete="current-password" />
                @if (Route::has('password.request'))
                    <a class="absolute right-0 top-0 text-sm text-primary underline-offset-4 hover:underline" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                @endif
            </div>
            <label class="flex items-center gap-2 text-sm text-muted-foreground">
                <april:input type="checkbox" name="remember" value="1" :checked="old('remember')" />
                {{ __('Remember me') }}
            </label>
            <april:button type="submit" class="w-full" data-test="login-button">{{ __('Log in') }}</april:button>
        </form>

        <p class="text-center text-sm text-muted-foreground">
            {{ __('Don\'t have an account?') }}
            <a class="text-primary underline-offset-4 hover:underline" href="{{ route('register') }}">{{ __('Sign up') }}</a>
        </p>
    </div>
</x-layouts::auth>
