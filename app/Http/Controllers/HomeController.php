<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
{
    $books = Book::with('user')  // Eager load user relationship
    ->latest()              // Newest books first
    ->get();

return view('home.index', compact('books'));
}

}