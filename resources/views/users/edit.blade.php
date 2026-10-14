<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="mb-4">
                            <label for="name"
                                class="block font-medium text-sm text-gray-700">
                                Name
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required>

                            @error('name')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <label for="email"
                                class="block font-medium text-sm text-gray-700">
                                Email
                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required>

                            @error('email')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div class="mb-4">
                            <label for="role"
                                class="block font-medium text-sm text-gray-700">
                                Role
                            </label>

                            <select
                                id="role"
                                name="role"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required>

                                @if (auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR))

                                <option value="system_administrator"
                                    {{ old('role', $user->role?->value) === 'system_administrator' ? 'selected' : '' }}>
                                    System Administrator
                                </option>

                                <option value="company_administrator"
                                    {{ old('role', $user->role?->value) === 'company_administrator' ? 'selected' : '' }}>
                                    Company Administrator
                                </option>

                                @elseif (auth()->user()->hasRole(\App\UserRole::COMPANY_ADMINISTRATOR))

                                <option value="company_administrator"
                                    {{ old('role', $user->role?->value) === 'company_administrator' ? 'selected' : '' }}>
                                    Company Administrator
                                </option>

                                <option value="quality_engineer"
                                    {{ old('role', $user->role?->value) === 'quality_engineer' ? 'selected' : '' }}>
                                    Quality Engineer
                                </option>

                                <option value="production_supervisor"
                                    {{ old('role', $user->role?->value) === 'production_supervisor' ? 'selected' : '' }}>
                                    Production Supervisor
                                </option>

                                <option value="quality_manager"
                                    {{ old('role', $user->role?->value) === 'quality_manager' ? 'selected' : '' }}>
                                    Quality Manager
                                </option>

                                @endif

                            </select>

                            @error('role')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Company --}}
                        <div class="mb-4">

                            <label
                                for="company_id"
                                class="block font-medium text-sm text-gray-700">
                                Company
                            </label>

                            @if (auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR)
                            && $user->role?->value === \App\UserRole::SYSTEM_ADMINISTRATOR->value)

                            {{-- System Administrator must not belong to a company --}}
                            <input
                                type="text"
                                value="No Company"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm bg-gray-100"
                                disabled>

                            <input
                                type="hidden"
                                name="company_id"
                                value="">

                            @else

                            <select
                                id="company_id"
                                name="company_id"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required>

                                @foreach ($companies as $company)

                                <option
                                    value="{{ $company->id }}"
                                    {{ (int) old('company_id', $user->company_id) === (int) $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>

                                @endforeach

                            </select>

                            @endif

                            @error('company_id')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>

                        @error('company_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="px-4 py-2 bg-gray-800 text-white rounded-md">
                    Update User
                </button>

                </form>

            </div>
        </div>

    </div>
    </div>
</x-app-layout>