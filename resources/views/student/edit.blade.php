<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Student') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Profile Information') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Update your account's profile information and email address.") }}
                    </p>
                </header>

                <form action="{{ route('verification.send') }}" id="send-verification" method="post">
                    @csrf
                </form>

                <form action="{{ route('student.update', [$student]) }}" class="mt-6 grid gap-4 space-y-6 lg:grid-cols-2"
                    method="post">
                    @csrf
                    @method('patch')
                    <div>
                        <x-input-label :value="__('Name')" for="name" />
                        <x-text-input :value="old('name', $student->user->name)" autocomplete="name" autofocus class="mt-1 block w-full"
                            id="name" name="name" required type="text" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>

                        @if ($student->user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$student->user->hasVerifiedEmail())
                            <div>
                                <p class="mt-2 text-sm text-gray-800">
                                    {{ __('Your email address is unverified.') }}

                                    <button
                                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                        form="send-verification">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 text-sm font-medium text-green-600">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div>
                        <x-input-label :value="__('Sex')" for="sex" />
                        <select class="border-1 mt-1 w-full rounded-md" id="sex" name="sex">
                            <option {{ $student->sex == 'male' ? 'selected' : '' }} value="male">Male</option>
                            <option {{ $student->sex == 'female' ? 'selected' : '' }} value="female">Female</option>
                        </select>
                        <x-input-error :messages="$errors->get('age')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label :value="__('Age')" for="age" />
                        <x-text-input :value="old('age', $student->age)" autocomplete="age" class="mt-1 block w-full" id="age"
                            name="age" required type="number" />
                        <x-input-error :messages="$errors->get('age')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label :value="__('Address')" for="address" />
                        <x-text-input :value="old('address', $student->address)" autocomplete="address" class="mt-1 block w-full" id="address"
                            name="address" required type="text" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label :value="__('Course')" for="course" />
                        <x-text-input :value="old('address', $student->course)" autocomplete="course" class="mt-1 block w-full" id="course"
                            name="course" required type="text" />
                        <x-input-error :messages="$errors->get('course')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label :value="__('Year')" for="year" />
                        <x-text-input :value="old('year', $student->year)" autocomplete="year" class="mt-1 block w-full" id="year"
                            name="year" required type="number" />
                        <x-input-error :messages="$errors->get('year')" class="mt-2" />
                    </div>

                    <div class="col-span-2 flex items-center justify-center gap-4">
                        <x-primary-button>{{ __('Update') }}</x-primary-button>

                        @if (session('status') === 'profile-updated')
                            <p class="text-sm text-gray-600" x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)"
                                x-show="show" x-transition>{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>
            </section>

        </div>
    </div>
</x-app-layout>
