<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold">
                            {{ $company->name }}
                        </h3>

                        <a
                            href="{{ route('companies.index') }}"
                            class="px-3 py-2 bg-gray-800 text-white rounded-md"
                        >
                            Back to Companies
                        </a>
                    </div>

                    <div class="space-y-3">

                        <p>
                            <strong>Company Name:</strong>
                            {{ $company->name }}
                        </p>

                        <p>
                            <strong>Company Code:</strong>
                            {{ $company->code }}
                        </p>

                        <p>
                            <strong>Industry:</strong>
                            {{ $company->industry ?? 'Not Set' }}
                        </p>

                        <p>
                            <strong>Contact Email:</strong>
                            {{ $company->contact_email ?? 'Not Set' }}
                        </p>

                        <p>
                            <strong>Contact Phone:</strong>
                            {{ $company->contact_phone ?? 'Not Set' }}
                        </p>

                        <p>
                            <strong>Address:</strong>
                            {{ $company->address ?? 'Not Set' }}
                        </p>

                        <p>
                            <strong>City:</strong>
                            {{ $company->city ?? 'Not Set' }}
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
                            <strong>Total Users:</strong>
                            {{ $company->users->count() }}
                        </p>

                        <p>
                            <strong>Created:</strong>
                            {{ $company->created_at->format('d M Y, h:i A') }}
                        </p>

                        <p>
                            <strong>Last Updated:</strong>
                            {{ $company->updated_at->format('d M Y, h:i A') }}
                        </p>

                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>