<x-guest-layout>
    <form action="{{ route('register') }}" method="POST">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label :value="__('Name')" for="name" />
            <x-text-input :value="old('name')" autocomplete="name" autofocus class="mt-1 block w-full" id="name"
                name="name" required type="text" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label :value="__('Email')" for="email" />
            <x-text-input :value="old('email')" autocomplete="username" class="mt-1 block w-full" id="email"
                name="email" required type="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label :value="__('Password')" for="password" />

            <x-text-input autocomplete="new-password" class="mt-1 block w-full" id="password" name="password" required
                type="password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label :value="__('Confirm Password')" for="password_confirmation" />

            <x-text-input autocomplete="new-password" class="mt-1 block w-full" id="password_confirmation"
                name="password_confirmation" required type="password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="border-b-2 mt-8" ></div>

        <div class="mt-4">
            <x-input-label :value="__('Sex')" for="sex" />
           <select name="sex" id="sex" class="rounded-md w-full border-0" >
                <option :value="null">Select Sex</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
           </select>
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label :value="__('Age')" for="age" />
            <x-text-input  class="mt-1 block w-full" id="age"
                name="age" required type="number" />
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label :value="__('Address')" for="address" />
            <x-text-input  class="mt-1 block w-full" id="address"
                name="address" required type="text" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label :value="__('Course')" for="course" />
            <x-text-input  class="mt-1 block w-full" id="course"
                name="course" required type="text" />
            <x-input-error :messages="$errors->get('course')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label :value="__('Year')" for="year" />
            <x-text-input  class="mt-1 block w-full" id="year"
                name="year" required type="number" />
            <x-input-error :messages="$errors->get('year')" class="mt-2" />
        </div>

        <div class="mt-4 flex items-center justify-end">
            <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
