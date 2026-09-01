<x-layouts::auth :title="__('Email verification')">
    <div class="flex flex-col gap-6 text-center">
        <x-auth-header :title="__('Verify your email')" :description="__('Please verify your email address by clicking on the link we just emailed to you.')" />
        @if (session('status') == 'verification-link-sent')
            <p class="text-sm font-medium text-green-600">{{ __('A new verification link has been sent to the email address you provided during registration.') }}</p>
        @endif
        <div class="flex flex-col items-center gap-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <april:button type="submit">{{ __('Resend verification email') }}</april:button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <april:button variant="ghost" type="submit" class="text-sm" data-test="logout-button">{{ __('Log out') }}</april:button>
            </form>
        </div>
    </div>
</x-layouts::auth>
