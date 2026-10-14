<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-6">
                        Create New Company
                    </h3>

                    <form method="POST" action="{{ route('companies.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                Company Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                Company Code
                            </label>

                            <input
                                type="text"
                                name="code"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                Industry
                            </label>

                            <input
                                type="text"
                                name="industry"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                            >
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                Contact Email
                            </label>

                            <input
                                type="email"
                                name="contact_email"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                            >
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                Contact Phone
                            </label>

                            <input
                                type="text"
                                name="contact_phone"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                            >
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                Address
                            </label>

                            <textarea
                                name="address"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                rows="3"
                            ></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">
                                City
                            </label>

                            <input
                                type="text"
                                name="city"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                            >
                        </div>

                        <div class="mb-6">
                            <label class="block font-medium text-sm text-gray-700">
                                Country
                            </label>

                            <input
                                type="text"
                                name="country"
                                value="Bangladesh"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                            >
                        </div>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md"
                        >
                            Create Company
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>