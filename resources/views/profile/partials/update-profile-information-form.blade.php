<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information.") }}
        </p>
    </header>

    {{-- Email Verification Form --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Main Profile Update Form --}}
    <form
        method="post"
        action="{{ route('profile.update') }}"
        enctype="multipart/form-data"
        class="mt-6 space-y-6"
    >
        @csrf
        @method('patch')

        {{-- Profile Photo --}}
        <div>
            <x-input-label for="profile_photo" :value="__('Profile Photo')" />

            @if ($user->profile_photo_path)
                <div class="mt-3">
                    <img
                        src="{{ asset('storage/' . $user->profile_photo_path) }}"
                        alt="{{ $user->name }}"
                        class="h-24 w-24 rounded-full object-cover border border-gray-300 dark:border-gray-600"
                    />
                </div>
            @else
                <div class="mt-3 flex h-24 w-24 items-center justify-center rounded-full bg-gray-200 dark:bg-gray-700">
                    <span class="text-2xl font-semibold text-gray-600 dark:text-gray-300">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </span>
                </div>
            @endif

            <input
                id="profile_photo"
                name="profile_photo"
                type="file"
                accept="image/jpeg,image/png,image/webp"
                class="mt-3 block w-full text-sm text-gray-700 dark:text-gray-300"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('profile_photo')"
            />
        </div>

        {{-- Full Name --}}
        <div>
            <x-input-label for="name" :value="__('Full Name')" />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button
                            form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        >
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Phone --}}
        <div>
            <x-input-label for="phone" :value="__('Phone Number')" />

            <x-text-input
                id="phone"
                name="phone"
                type="text"
                class="mt-1 block w-full"
                :value="old('phone', $user->phone)"
                autocomplete="tel"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('phone')"
            />
        </div>

        {{-- Job Title --}}
        <div>
            <x-input-label for="job_title" :value="__('Job Title')" />

            <x-text-input
                id="job_title"
                name="job_title"
                type="text"
                class="mt-1 block w-full"
                :value="old('job_title', $user->job_title)"
                autocomplete="organization-title"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('job_title')"
            />
        </div>

        {{-- Department --}}
        <div>
            <x-input-label for="department" :value="__('Department')" />

            <x-text-input
                id="department"
                name="department"
                type="text"
                class="mt-1 block w-full"
                :value="old('department', $user->department)"
                autocomplete="organization"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('department')"
            />
        </div>

        {{-- Save Button --}}
        <div class="flex items-center gap-4">
            <x-primary-button>
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>

    {{-- Delete Profile Photo --}}
    @if ($user->profile_photo_path)
        <form
            method="post"
            action="{{ route('profile.photo.delete') }}"
            class="mt-3"
        >
            @csrf
            @method('delete')

            <x-danger-button>
                {{ __('Delete Photo') }}
            </x-danger-button>
        </form>
    @endif
</section>