<x-layouts::auth :title="__('Log in')">
    <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-white/10 dark:bg-zinc-900 sm:p-8">
        <div class="flex flex-col gap-6">
            <x-auth-header
                :title="__('Log in to your account')"
                :description="__('Enter your email and password below to log in')"
            />

            <x-auth-session-status class="text-center" :status="session('status')" />

            <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-4">
                @csrf

                
                <flux:input
                    name="email"
                    :label="__('Email address')"
                    :value="old('email')"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="email@example.com"
                />

                
                <div class="relative">
                    <flux:input
                        name="password"
                        :label="__('Password')"
                        type="password"
                        required
                        autocomplete="current-password"
                        :placeholder="__('Password')"
                        viewable
                    />

                    @if (Route::has('password.request'))
                        <flux:link
                            class="absolute top-0 end-0 text-sm"
                            :href="route('password.request')"
                            wire:navigate
                        >
                            {{ __('Forgot your password?') }}
                        </flux:link>
                    @endif
                </div>

                
                <flux:checkbox name="remember" :label="__('Remember me')" :checked="old('remember')" />

                <flux:button variant="primary" type="submit" class="w-full" data-test="login-button">
                    {{ __('Log in') }}
                </flux:button>
            </form>
        </div>
    </div>

    @if (Route::has('register'))
        <p class="text-center text-sm text-zinc-600 dark:text-zinc-400">
            {{ __("Don't have an account?") }}
            <flux:link :href="route('register')" wire:navigate>
                {{ __('Sign up') }}
            </flux:link>
        </p>
    @endif
</x-layouts::auth>
