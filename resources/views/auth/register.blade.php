<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{url('images/logo.png')}}" width="80" alt="">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-jet-label for="nik" value="{{ __('NIK') }}" />
                <x-jet-input id="nik" class="block mt-1 w-full" type="text" name="nik" :value="old('nik')" required
                    autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Nama Lengkap') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="place_of_birth" value="{{ __('Tempat Lahir') }}" />
                <x-jet-input id="place_of_birth" class="block mt-1 w-full" type="text" name="place_of_birth"
                    :value="old('place_of_birth')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="date_of_birth" value="{{ __('Tanggal Lahir') }}" />
                <x-jet-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth"
                    :value="old('date_of_birth')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Alamat') }}" />
                <textarea class="block mt-1 w-full" name="address" id="address" cols="30" rows="5"
                    required>{{old('address')}}</textarea>
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <div class="mt-4">
                <x-jet-label for="gender" value="{{ __('Jenis Kelamin') }}" />
                <label for="male" class="mr-4">
                    <input id="male" type="radio" name="gender" value="male" />
                    Laki-laki
                </label>
                <label for="female">
                    <input id="female" type="radio" name="gender" value="female" />
                    Perempuan
                </label>
            </div>

            <div class="mt-4">
                <x-jet-label for="phone" value="{{ __('No.Handphone') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="tel" name="phone" required
                    :value="old('phone')" />
            </div>

            <div class="mt-4">
                <x-jet-label for="ktp" value="{{ __('Scane KTP') }}" />
                <img src="{{url('images/ktp.jpg')}}" style="width: 100%" alt="">
                <x-jet-input id="ktp" class="block mt-1 w-full" type="file" name="ktp" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="kk" value="{{ __('Scane KK') }}" />
                <img src="{{url('images/kk.png')}}" style="width: 100%" alt="">
                <x-jet-input id="kk" class="block mt-1 w-full" type="file" name="kk" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-jet-label for="terms">
                    <div class="flex items-center">
                        <x-jet-checkbox name="terms" id="terms" />

                        <div class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of
                                Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy
                                Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-jet-label>
            </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>