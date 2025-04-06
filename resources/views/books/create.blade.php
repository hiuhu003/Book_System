<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
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

    <!-- Add Book Section -->
    <div class="min-h-screen flex items-center justify-center px-4 mt-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-xl shadow-lg">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900">Add a New Book</h2>
                <p class="mt-2 text-sm text-gray-600">Share your favorite book with the community</p>
            </div>

            <form method="POST" action="{{ route('books.store') }}" class="mt-8 space-y-6">
                @csrf
                <div class="rounded-md shadow-sm space-y-4">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Book Title</label>
                        <input id="title" name="title" type="text" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter book title">
                    </div>

                    <!-- Author -->
                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                        <input id="author" name="author" type="text" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter author name">
                    </div>

                    <!-- Year -->
                    <div>
                        <label for="publication_year" class="block text-sm font-medium text-gray-700 mb-1">Publication Year</label>
                        <input id="publication_year" name="publication_year" type="number" min="1900" max="{{ date('Y') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="YYYY">
                    </div>

                    <!-- Recommendations Textarea -->
                    <div>
                        <label for="recommendations" class="block text-sm font-medium text-gray-700 mb-1">Recommendations</label>
                        <textarea id="recommendations" name="recommendations" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Share your thoughts about the book..."></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Book
                </button>
            </form>
        </div>
    </div>
</body>
</html>