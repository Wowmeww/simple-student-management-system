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

    <form action="{{ route('profile.update') }}" method="post">
        @csrf
        @method('patch')
        <div class="mt-6 grid gap-4 lg:grid-cols-2" >
            <div>
                <x-input-label :value="__('Name')" for="name" />
                <x-text-input :value="old('name', $user->name)" autocomplete="name" autofocus class="mt-1 block w-full" id="name"
                    name="name" required type="text" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label :value="__('Email')" for="email" />
                <x-text-input :value="old('email', $user->email)" autocomplete="username" class="mt-1 block w-full" id="email"
                    name="email" required type="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
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
        </div>

        @if ($user->role == 'student')
            <div class="mt-6 grid gap-4 lg:grid-cols-2" >
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
            </div>
        @endif

        <div class="col-span-2 flex items-center justify-center gap-4 mt-6">
            <x-primary-button>{{ __('Update') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-gray-600" x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" x-show="show"
                    x-transition>{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
