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

                    @if (session('success'))
                        <div class="mb-4 rounded-md bg-green-100 px-4 py-3 text-sm text-green-800">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-3">
                        @foreach ($users as $user)
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
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>