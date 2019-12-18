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
//        $inputs["radio_1"] = 0;
        $inputs["radio_2"] = 0;
//debug_dump($inputs );
//exit();
        $book = new Book();
        $book->fill($inputs);
        $book->save();
        return redirect()->route('books.index');
    }
    /**************************************
     *
     **************************************/
    public function show($id)
    {
        $book = Book::find($id);
        return view('books/show')->with('book', $book );
    }    
    /**************************************
     *
     **************************************/
    public function edit($id)
    {
        $book = Book::find($id);
//debug_dump($book );
//exit();
        return view('books/edit')->with('book', $book );
    }    
    /**************************************
     *
     **************************************/    
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        if(empty($inputs["check_1"] )){
            $inputs["check_1"] = 0;
        }
        if(empty($inputs["check_2"] )){
            $inputs["check_2"] = 0;
        }
//debug_dump($inputs );
//exit();
        $book = Book::find($id);
        $book->fill($inputs );
        $book->save();
        return redirect()->route('books.index');
    }

}
