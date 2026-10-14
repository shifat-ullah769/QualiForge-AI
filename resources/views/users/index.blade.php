<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-4">
                        Users
                    </h3>


                    {{-- Success Message --}}
                    @if (session('success'))

                    <div class="mb-4 rounded-md bg-green-100 px-4 py-3 text-sm text-green-800">
                        {{ session('success') }}
                    </div>

                    @endif


                    {{-- Create User --}}
                    <div class="mb-4">

                        <a
                            href="{{ route('users.create') }}"
                            style="
                                display: inline-block;
                                background-color: #2563eb;
                                color: white;
                                padding: 8px 14px;
                                border-radius: 6px;
                                text-decoration: none;
                                font-weight: 500;
                            ">
                            Create User
                        </a>

                    </div>


                    {{-- Users --}}
                    <div class="space-y-3">

                        @forelse ($users as $user)

                        <div class="border rounded-md p-4">

                            <p>
                                <strong>Name:</strong>
                                {{ $user->name }}
                            </p>


                            <p>
                                <strong>Email:</strong>
                                {{ $user->email }}
                            </p>


                            <p>
                                <strong>Role:</strong>
                                {{ $user->role?->value ?? 'Not Assigned' }}
                            </p>


                            <p>
                                <strong>Company:</strong>
                                {{ $user->company?->name ?? 'No Company' }}
                            </p>


                            <p>
                                <strong>Status:</strong>

                                @if ($user->is_active)

                                <span style="color: green; font-weight: 600;">
                                    Active
                                </span>

                                @else

                                <span style="color: red; font-weight: 600;">
                                    Inactive
                                </span>

                                @endif

                            </p>


                            {{-- Deactivation Date --}}
                            @if (!$user->is_active && $user->deactivated_at)

                            <p>
                                <strong>Deactivated:</strong>
                                {{ $user->deactivated_at->format('d M Y, h:i A') }}
                            </p>

                            @endif


                            {{-- Action Buttons --}}
                            <div class="mt-4 flex gap-2 flex-wrap">


                                {{-- Edit User --}}
                                @if (
                                auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR)
                                ||
                                (
                                auth()->user()->hasRole(\App\UserRole::COMPANY_ADMINISTRATOR)
                                && (int) auth()->user()->company_id === (int) $user->company_id
                                )
                                )

                                <a
                                    href="{{ route('users.edit', $user) }}"
                                    style="
                                                display: inline-block;
                                                background-color: #2563eb;
                                                color: white;
                                                padding: 8px 14px;
                                                border-radius: 6px;
                                                text-decoration: none;
                                                font-weight: 500;
                                            ">
                                    Edit User
                                </a>

                                @endif


                                {{-- Activate / Deactivate --}}
                                @if (
                                auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR)
                                ||
                                (
                                auth()->user()->hasRole(\App\UserRole::COMPANY_ADMINISTRATOR)
                                && (int) auth()->user()->company_id === (int) $user->company_id
                                )
                                )

                                {{-- System Admin cannot deactivate another System Admin --}}
                                @if (
                                !(
                                $user->role?->value === \App\UserRole::SYSTEM_ADMINISTRATOR->value
                                && $user->id !== auth()->id()
                                )
                                )

                                <form
                                    method="POST"
                                    action="{{ route('users.toggle-status', $user) }}">

                                    @csrf
                                    @method('PATCH')

                                    @if ($user->is_active)

                                    <button
                                        type="submit"
                                        style="
                                                            background-color: #dc2626;
                                                            color: white;
                                                            padding: 8px 14px;
                                                            border: none;
                                                            border-radius: 6px;
                                                            font-weight: 500;
                                                            cursor: pointer;
                                                        ">
                                        Deactivate User
                                    </button>

                                    @else

                                    <button
                                        type="submit"
                                        style="
                                                            background-color: #16a34a;
                                                            color: white;
                                                            padding: 8px 14px;
                                                            border: none;
                                                            border-radius: 6px;
                                                            font-weight: 500;
                                                            cursor: pointer;
                                                        ">
                                        Activate User
                                    </button>

                                    @endif

                                </form>

                                @endif

                                @endif


                                {{-- Delete User --}}
                                @if (
                                (
                                auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR)
                                && $user->role?->value === \App\UserRole::COMPANY_ADMINISTRATOR->value
                                )
                                ||
                                (
                                auth()->user()->hasRole(\App\UserRole::COMPANY_ADMINISTRATOR)
                                && (int) auth()->user()->company_id === (int) $user->company_id
                                )
                                )

                                <form
                                    method="POST"
                                    action="{{ route('users.destroy', $user) }}"
                                    onsubmit="return confirm('Are you sure you want to permanently delete this user?');">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        style="
                                                    background-color: #991b1b;
                                                    color: white;
                                                    padding: 8px 14px;
                                                    border: none;
                                                    border-radius: 6px;
                                                    font-weight: 500;
                                                    cursor: pointer;
                                                ">
                                        Delete User
                                    </button>

                                </form>

                                @endif


                            </div>

                        </div>

                        @empty

                        <p class="text-gray-600">
                            No users found.
                        </p>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>