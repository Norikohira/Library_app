<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';
    
    private $author;
    private $book;

    public function __construct(Author $author, Book $book)
    {
        $this->author = $author;
        $this->book = $book;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $all_books = $this->book->latest()->paginate(3); 
        $all_authors = Author::all(); 

        return view('pages.add-book', compact('all_books', 'all_authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Validate the request
        $request->validate([
            'title' => 'required|min:1|max:50',
            'yearPublished' => 'required|min:1|max:4',
            'cover' => 'required|mimes:jpg,jpeg,png,gif|max:1048',
            'isbn' => 'required|numeric|digits_between:10,13|unique:books,isbn'
        ]);

        # Save the request to the database
        $this->book->author_id = $request->author;
        //owner of the post             = the logged-in user
        $this->book->title = $request->title;
        $this->book->yearPublished = $request->yearPublished;
        $this->book->isbn = $request->isbn;

        if ($request->hasFile('cover')) {
            $this->book->cover = $this->saveImage($request);
        }

        $this->book->save();

        # Redirect to homepage
        return redirect()->route('book.create');
    }


    private function saveImage($request)
    {
        // Change the name of the image to the CURRENT TIME to avoid overwriting
        $image_name = time() . "." . $request->cover->extension();

        // Save the image inside the local storage ~~ storage/app/public/images
        $request->file('cover')->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);
        // storeAs(destination, file_name) ~~ used to store the uploaded file/image
        
        return $image_name;
    }

    /**
     * Display the specified resource.
     */
    public function preview($id)
    {
        $book = $this->book->findOrFail($id);
        $author = $this->author->findOrFail($book->author_id);

        return view('pages.preview')
            ->with('book', $book)
            ->with('author', $author);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = $this->book->findOrFail($id);
        $author = $this->author->findOrFail($book->author_id);
        $all_authors = Author::all(); 

        return view('pages.edit-book')
            ->with('book', $book)
            ->with('author', $author)
            ->with('all_authors', $all_authors);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:1|max:50',
            'yearPublished' => 'required|min:1|max:4',
            'cover' => 'mimes:jpg,jpeg,png,gif|max:1048',
            'isbn' => 'required|numeric|digits_between:10,13|unique:books,isbn'
            // mimes ~~ multipurpose internet mail extensions
        ]);

        $book           = $this->book->findOrFail($id);
        $book->title    = $request->title;
        $book->yearPublished     = $request->yearPublished;
        $book->isbn     = $request->isbn;

        # If there is a NEW image...
        if($request->cover){
            # DELETE the previous image from the local storage folder
            $this->deleteImage($book->cover);

            # MOVE the new image to the local storage folder
            $book->cover = $this->saveImage($request);
        }

        $book->save();
        return redirect()->route('book.preview', $id);
    }


    private function deleteImage($image_name)
    {
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;
        // $image_path = "/public/images/12345.jpg";

        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

    public function show($id)
    {
        $book = $this->book->findOrFail($id);

        return view('pages.delete-book')->with('book', $book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = $this->book->findOrFail($id);

        $this->deleteImage($book->cover);
        
        $book->delete();

        return redirect()->route('book.create');
    }
}
