<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>

                <a href="{{ route('books.book-listing') }}"
                    class="bg-red-600 py-4 px-4 text-white text-center rounded-none">Book Listing</a>
                <a href="{{ route('reserves.reserve-listing') }}"
                    class="bg-red-600 py-4 px-4 text-white text-center rounded-none">Reserve Listing</a>

            </div>
        </div>
    </div>
</x-app-layout>
