<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub - Manage Your Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Function to open the modal
        function openModal(bookId) {
            document.getElementById('book-modal-' + bookId).classList.remove('hidden');
        }

        // Function to close the modal
        function closeModal(bookId) {
            document.getElementById('book-modal-' + bookId).classList.add('hidden');
        }
    </script>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-600">BookHub</a>
                </div>
                <div>
                    <!-- Login Button -->
                    <a href="{{ route('login') }}" class="px-4 py-2 text-gray-600 hover:text-blue-600 transition">Login</a>
                    
                    <!-- Register Button -->
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-blue-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Your Personal Book Library</h1>
            <p class="text-xl text-blue-100">Organize, manage, and cherish your reading journey</p>
        </div>
    </header>

    


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Community Library</h2>

                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Year</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recommendations</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Added By</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($books as $book)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $book->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $book->author }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $book->publication_year }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">{{ $book->recommendations }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $book->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-blue-600 cursor-pointer">
                                        <button onclick="openModal({{ $book->id }})" class="hover:text-blue-800 transition">View Details</button>
                                    </td>
                                </tr>

                                <!-- Book Detail Modal -->
                                <div id="book-modal-{{ $book->id }}" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 flex justify-center items-center">
                                    <div class="bg-white rounded-lg p-8 max-w-2xl mx-auto relative">
                                        <!-- Close Button -->
                                        <button onclick="closeModal({{ $book->id }})" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 text-xl font-bold">&times;</button>
                                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">{{ $book->title }} - Details</h3>
                                        <p class="text-lg text-gray-700"><strong>Author:</strong> {{ $book->author }}</p>
                                        <p class="text-lg text-gray-700"><strong>Year:</strong> {{ $book->publication_year }}</p>
                                        <p class="text-lg text-gray-700"><strong>Recommendations:</strong> {{ $book->recommendations }}</p>
                                        <p class="text-lg text-gray-700"><strong>Added By:</strong> {{ $book->user->name }}</p>
                                        <p class="text-lg text-gray-700"><strong>Description:</strong> {{ $book->description }}</p>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No books in the library yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center">
                <p class="text-gray-400">&copy; 2024 BookHub. All rights reserved.</p>
                <div class="mt-2">
                    <a href="#" class="text-gray-400 hover:text-white mx-2">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white mx-2">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
