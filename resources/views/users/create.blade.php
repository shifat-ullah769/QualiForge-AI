<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-4">
                            <label
                                for="name"
                                class="block font-medium text-sm text-gray-700"
                            >
                                Name
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required
                                autofocus
                            >

                            @error('name')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <label
                                for="email"
                                class="block font-medium text-sm text-gray-700"
                            >
                                Email
                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required
                            >

                            @error('email')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-4">
                            <label
                                for="password"
                                class="block font-medium text-sm text-gray-700"
                            >
                                Password
                            </label>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required
                            >

                            @error('password')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-4">
                            <label
                                for="password_confirmation"
                                class="block font-medium text-sm text-gray-700"
                            >
                                Confirm Password
                            </label>

                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required
                            >
                        </div>

                        {{-- Role --}}
                        <div class="mb-4">
                            <label
                                for="role"
                                class="block font-medium text-sm text-gray-700"
                            >
                                Role
                            </label>

                            <select
                                id="role"
                                name="role"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required
                            >
                                <option value="system_administrator"
                                    {{ old('role') === 'system_administrator' ? 'selected' : '' }}>
                                    System Administrator
                                </option>

                                <option value="company_administrator"
                                    {{ old('role') === 'company_administrator' ? 'selected' : '' }}>
                                    Company Administrator
                                </option>

                                <option value="quality_engineer"
                                    {{ old('role') === 'quality_engineer' ? 'selected' : '' }}>
                                    Quality Engineer
                                </option>

                                <option value="production_supervisor"
                                    {{ old('role') === 'production_supervisor' ? 'selected' : '' }}>
                                    Production Supervisor
                                </option>

                                <option value="quality_manager"
                                    {{ old('role') === 'quality_manager' ? 'selected' : '' }}>
                                    Quality Manager
                                </option>
                            </select>

                            @error('role')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <button
                            type="submit"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md"
                        >
                            Create User
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>