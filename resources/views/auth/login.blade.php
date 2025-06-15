<x-guest-layout>
    <div class="max-w-md mx-auto mt-10 bg-white p-8 shadow-lg rounded-xl">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Welcome Back</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Login Actions -->
            <div class="flex items-center justify-between mt-6">
                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        <div class="mt-6">
            <p class="text-center text-gray-500 text-sm mb-4">Or login with</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('socialite.redirect', 'google') }}" class="flex items-center gap-2 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21.805 10.023H12v3.95h5.644c-.6 2.18-2.68 3.75-5.64 3.75a6.33 6.33 0 0 1 0-12.66c1.71 0 3.26.68 4.37 1.78l2.91-2.91C17.91 2.43 15.1 1.23 12 1.23 5.92 1.23 1 6.15 1 12.23c0 6.08 4.92 11 11 11 6.08 0 11-4.92 11-11 0-.68-.07-1.34-.2-1.98z"/>
                    </svg>
                    Google
                </a>
                <a href="{{ route('socialite.redirect', 'github') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-900 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 .5C5.65.5.5 5.65.5 12a11.5 11.5 0 0 0 7.84 10.95c.57.1.77-.25.77-.55v-2c-3.18.7-3.85-1.54-3.85-1.54a3.04 3.04 0 0 0-1.28-1.68c-1.05-.72.08-.7.08-.7a2.4 2.4 0 0 1 1.76 1.18 2.44 2.44 0 0 0 3.33.95c.03-.63.24-1.07.44-1.31-2.54-.29-5.22-1.27-5.22-5.64 0-1.25.45-2.27 1.18-3.07a4.1 4.1 0 0 1 .11-3.03s.96-.31 3.15 1.18a10.87 10.87 0 0 1 5.74 0c2.19-1.49 3.15-1.18 3.15-1.18.62 1.59.22 2.76.11 3.03a4.23 4.23 0 0 1 1.18 3.07c0 4.38-2.68 5.35-5.23 5.63.25.22.47.66.47 1.33v2c0 .3.2.65.78.54A11.5 11.5 0 0 0 23.5 12c0-6.35-5.15-11.5-11.5-11.5z"/>
                    </svg>
                    GitHub
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
