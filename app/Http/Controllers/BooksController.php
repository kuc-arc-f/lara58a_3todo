<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BooksController extends Controller
{
    /**************************************
     *
     **************************************/
    public function index()
    {
//var_dump("#index");
        $books = Book::orderBy('updated_at', 'desc')->paginate(5);
        return view('books/index')->with('books', $books);
    }    
    /**************************************
     *
     **************************************/
    public function create()
    {
        return view('books/create')->with('book', new Book());
    }    
    /**************************************
     *
     **************************************/    
    public function store(Request $request)
    {
        $inputs = $request->all();
        $book = new Book();
        $book->fill($inputs);
        $book->save();
        return redirect()->route('books.index');
    }


}
