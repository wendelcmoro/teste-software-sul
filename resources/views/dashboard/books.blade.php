<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Listing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (auth()->User()->type == 'ADMIN')
                <a href="{{ route('books.edit-book') }}"
                    class="text-xl p-4 text-center font-bold bg-green-700 text-white">Create
                    New
                    Book</a>
            @endif

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
                <div class="grid grid-cols-7 gap-4 font-bold">
                    <div class=" p-4 text-center">Title</div>
                    <div class=" p-4 text-center">Author</div>
                    <div class=" p-4 text-center">Description</div>
                    <div class=" p-4 text-center">ISBN</div>
                    <div class=" p-4 text-center">Quantity Available</div>
                    <div class=" p-4 text-center">Actions</div>
                </div>
                @foreach ($books as $book)
                    <div class="grid grid-cols-7 gap-4">
                        <div class="p-4 text-center">{{ $book->title }}</div>
                        <div class="p-4 text-center">{{ $book->author }}</div>
                        <div class="p-4 text-center">{{ $book->description }}</div>
                        <div class="p-4 text-center">{{ $book->isbn }}</div>
                        <div class="p-4 text-center">{{ $book->quantity_available }}</div>
                        <div class="grid grid-cols-3 gap-4">
                            @if (auth()->User()->type == 'ADMIN')
                                <a href="{{ route('books.edit-book', [$book->id]) }}"
                                    class="p-4 text-end text-red-500 font-bold">Edit</a>
                            @endif
                            @if (auth()->User()->type == 'ADMIN')
                                <form action="{{ route('books.delete-book', [$book->id]) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="submit" class="p-4 text-end text-red-500 font-bold">
                                        Delete
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('reserves.reserve-book', [$book->id]) }}" method="POST"
                                class="inline">
                                @csrf
                                <button type="submit"
                                    class="p-4 text-start text-red-500 font-bold bg-transparent border-none cursor-pointer">
                                    Reserve
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
