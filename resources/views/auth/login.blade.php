<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="accept_terms" class="flex items-center">
                    <x-checkbox id="accept_terms" name="accept_terms" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Al iniciar sesión, aceptas los ') }}</span>
                    <a href="{{ route('terms') }}" class="text-sm underline ml-1"
                        target="_blank">{{ __(' Terminos y condiciones') }}</a>
                </label>
            </div>
            <div class="block mt-4">
                <label for="policy" class="flex items-center">
                    <x-checkbox id="policy" name="policy" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Al iniciar sesión, aceptas los ') }}</span>
                    <a href="{{ route('policy') }}" class="text-sm underline ml-1"
                        target="_blank">{{ __(' Politicas de privacidad') }}</a>
                </label>
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4" id="login_button" disabled>
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const acceptTermsCheckbox = document.getElementById('accept_terms');
            const policyCheckbox = document.getElementById('policy');
            const loginButton = document.getElementById('login_button');

            let isAcceptTermsChecked = acceptTermsCheckbox.checked;
            let isPolicyChecked = policyCheckbox.checked;

            acceptTermsCheckbox.addEventListener('change', function() {
                isAcceptTermsChecked = this.checked;
                loginButton.disabled = !(isAcceptTermsChecked && isPolicyChecked);
            });

            policyCheckbox.addEventListener('change', function() {
                isPolicyChecked = this.checked;
                loginButton.disabled = !(isAcceptTermsChecked && isPolicyChecked);
            });
        });
    </script>
</x-guest-layout>
