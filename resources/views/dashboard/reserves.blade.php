<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reserve Listing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Search -->
            <form method="GET" action="{{ route('books.book-listing') }}" class="mb-4 flex space-x-4">
                <input type="text" name="search" placeholder="Search by Title, Author, or ISBN"
                    class="p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none w-full"
                    value="{{ request('search') }}">

                <button type="submit" class="p-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Search
                </button>
            </form>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-6 gap-4 font-bold">
                    <div class=" p-4 text-center">Title</div>
                    <div class=" p-4 text-center">Author</div>
                    <div class=" p-4 text-center">Description</div>
                    <div class=" p-4 text-center">ISBN</div>
                    <div class=" p-4 text-center">User</div>
                    <div class=" p-4 text-center">Actions</div>
                </div>
                @foreach ($reserves as $reserve)
                    <div class="grid grid-cols-6 gap-4">
                        <div class="p-4 text-center">{{ $reserve->book->title }}</div>
                        <div class="p-4 text-center">{{ $reserve->book->author }}</div>
                        <div class="p-4 text-center">{{ $reserve->book->description }}</div>
                        <div class="p-4 text-center">{{ $reserve->book->isbn }}</div>
                        <div class="p-4 text-center">{{ $reserve->user->name }}</div>
                        <form action="{{ route('reserves.cancel-reserve', [$reserve->id]) }}" method="POST"
                            class="inline text-center">
                            @csrf
                            <button type="submit"
                                class="p-4 text-red-500 font-bold bg-transparent border-none cursor-pointer">
                                Cancel Reserve
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
