<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    private $author;
    private $book;

    public function __construct(Author $author, Book $book)
    {
        $this->author = $author;
        $this->book = $book;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authorCount = $this->author->count();

        $bookCount = $this->book->count();

        return view('pages.dashboard', compact('authorCount', 'bookCount'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $all_authors = Author::all(); 

        return view('pages.add-author', compact('all_authors'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:50'
        ]);

        $this->author->name       = $request->name;
        $this->author->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $author = $this->author->findOrFail($id);

        return view('pages.delete-author')->with('author', $author);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $author = $this->author->findOrFail($id);

        return view('pages.edit-author')->with('author', $author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:1|max:50'
        ]);

        $author           = $this->author->findOrFail($id);
        $author->name     = $request->name;
        $author->save();

        return redirect()->route('author.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $author = $this->author->findOrFail($id);

        $author->delete();

        return redirect()->route('author.create');
    }
}
