<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="text-2xl font-bold text-blue-600">BookHub</a>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('books.index') }}" class="text-gray-600 hover:text-blue-600 px-3 py-2 rounded-md">Back to Books</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Edit Book Section -->
    <div class="min-h-screen flex items-center justify-center px-4 mt-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-xl shadow-lg">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900">Edit Book</h2>
                <p class="mt-2 text-sm text-gray-600">Make changes and update your book information</p>
            </div>

            <form method="POST" action="{{ route('books.update', $book->id) }}" class="mt-8 space-y-6">
                @csrf
                @method('PUT')
                <div class="rounded-md shadow-sm space-y-4">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Book Title</label>
                        <input id="title" name="title" type="text" value="{{ old('title', $book->title) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Author -->
                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                        <input id="author" name="author" type="text" value="{{ old('author', $book->author) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Year -->
                    <div>
                        <label for="publication_year" class="block text-sm font-medium text-gray-700 mb-1">Publication Year</label>
                        <input id="publication_year" name="publication_year" type="number"
                               value="{{ old('publication_year', $book->publication_year) }}" min="1900" max="{{ date('Y') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Recommendations -->
                    <div>
                        <label for="recommendations" class="block text-sm font-medium text-gray-700 mb-1">Recommendations</label>
                        <textarea id="recommendations" name="recommendations" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="Share your thoughts...">{{ old('recommendations', $book->recommendations) }}</textarea>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full flex justify-center items-center py-2 px-4 rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16h16V4H4zm8 4v8m-4-4h8" />
                    </svg>
                    Update Book
                </button>
            </form>
        </div>
    </div>
</body>
</html>
