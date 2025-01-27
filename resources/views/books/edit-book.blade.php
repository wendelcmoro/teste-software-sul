<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <body class="bg-gray-100 flex items-center justify-center h-screen">

                    <form action="{{ route('books.edit-book', $book ?? '') }}" method="POST"
                        class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">

                        <h1 class="text-2xl font-bold mb-4 text-gray-700">
                            @if ($book)
                                Editing Book
                            @else
                                New Book
                            @endif
                        </h1>

                        <!-- Title -->
                        @csrf
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" id="title" name="title" placeholder="Book Title" required
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none mb-4"
                            value={{ old('title', $book->title ?? '') }} @error('title') is-invalid @enderror>
                        @error('title')
                            <span role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Author -->
                        <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                        <input type="author" id="author" name="author" placeholder="Book Author" required
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none mb-4"
                            value={{ old('author', $book->author ?? '') }} @error('author') is-invalid @enderror>
                        @error('author')
                            <span role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Description -->
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea type="description" id="description" name="description" placeholder="Book Description" required
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none mb-4"
                            @error('description') is-invalid @enderror>{{ old('description', $book->description ?? '') }}</textarea>
                        @error('description')
                            <span role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- ISBN -->
                        <label for="isbn" class="block text-sm font-medium text-gray-700">ISBN</label>
                        <input type="isbn" id="isbn" name="isbn" placeholder="Book ISBN" required
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none mb-4"
                            value={{ old('isbn', $book->isbn ?? '') }} @error('isbn') is-invalid @enderror>
                        @error('isbn')
                            <span role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Quantity -->
                        <label for="quantity_available" class="block text-sm font-medium text-gray-700">Quantity
                            Available</label>
                        <input type="quantity_available" id="quantity_available" name="quantity_available"
                            placeholder="Quantity Available" required
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none mb-4"
                            value={{ old('quantity_available', $book->quantity_available ?? '') }}
                            @error('quantity_available') is-invalid @enderror>
                        @error('quantity_available')
                            <span role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <!-- Send Action -->
                        <button type="submit"
                            class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Send
                        </button>
                    </form>
            </div>
        </div>
    </div>
</x-app-layout>
