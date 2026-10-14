<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-4">
                        Companies
                    </h3>

                    @if (auth()->user()->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR))

                    <div class="mb-4">

                        <a
                            href="{{ route('companies.create') }}"
                            style="
                            display: inline-block;
                            background-color: #2563eb;
                            color: white;
                            padding: 8px 14px;
                            border-radius: 6px;
                            text-decoration: none;
                            font-weight: 500;
                        ">
                            Create Company
                        </a>

                    </div>

                    @endif

                    @if (session('success'))
                    <div class="mb-4 rounded-md bg-green-100 px-4 py-3 text-sm text-green-800">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="space-y-3">
                        @forelse ($companies as $company)
                        <div class="border rounded-md p-4">

                            <p>
                                <strong>Name:</strong>
                                {{ $company->name }}
                            </p>

                            <p>
                                <strong>Code:</strong>
                                {{ $company->code }}
                            </p>

                            <p>
                                <strong>Industry:</strong>
                                {{ $company->industry ?? 'Not Set' }}
                            </p>

                            <p>
                                <strong>Country:</strong>
                                {{ $company->country }}
                            </p>

                            <p>
                                <strong>Status:</strong>
                                {{ $company->is_active ? 'Active' : 'Inactive' }}
                            </p>

                            <p>
                                <strong>Users:</strong>
                                {{ $company->users()->count() }}
                            </p>

                            <div class="mt-4 flex gap-2">

                                <a
                                    href="{{ route('companies.show', $company) }}"
                                    style="display: inline-block; background-color: #374151; color: white; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
                                    View Details
                                </a>

                                <a
                                    href="{{ route('companies.edit', $company) }}"
                                    style="display: inline-block; background-color: #2563eb; color: white; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('companies.toggle-status', $company) }}">
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="px-3 py-2 bg-gray-800 text-white rounded-md">
                                        {{ $company->is_active ? 'Deactivate Company' : 'Activate Company' }}
                                    </button>
                                </form>

                            </div>

                        </div>
                        @empty
                        <p class="text-gray-600">
                            No companies found.
                        </p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>