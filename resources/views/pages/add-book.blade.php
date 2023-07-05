@extends('layouts.app')

@section('title', 'Library | Add Book')

@section('content')
<div class="container justify-content-center">
  <h2>Add new book</h2>
  <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="row">
      <div class="col-md-8 mt-3">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" placeholder="Add new book title">
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-4">
        <label for="yearPublished">Year Published</label>
        <input type="number" name="yearPublished" id="yearPublished" class="form-control" placeholder="YYYY">
      </div>
      
      <div class="col-md-4">
        <label for="author">Author</label>
        <select name="author" class="form-control">
          <option value="null">ANONIMOUS</option>
          @foreach($all_authors as $author)
            <option value="{{ $author->id }}">{{ $author->name }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-4">
        <label for="cover">Cover (optional)</label>
        <input type="file" name="cover" id="cover" class="form-control">
        <div class="form-text" id="image-info">
          Acceptable formats: jpeg, jpg, png, gif only<br>
          Maximum file size: 1048kb
        </div>
      </div>
      <div class="col-md-4">
        <label for="isbn">ISBN</label>
        <input type="text" name="isbn" id="isbn" class="form-control" placeholder="Add ISBN">
        @if ($errors->has('isbn'))
          <div class="alert alert-danger">
            {{ $errors->first('isbn') }}
          </div>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <button type="submit" class="btn btn-success form-control mt-3">+ Add</button>
      </div>
    </div>
  </form>

  <div class="row">
    <div class="col-md-8">
      <hr>
    </div>
  </div>

  <h2>List of Books</h2>
  @if($all_books->isEmpty())
    <p>No books yet</p>
  @else
    <div class="table-outer-wrapper">
      <table class="table table-white table-hover w-75">
        <thead>
          <tr>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Cover</th>
            <th>Created At</th>
            <th class="text-end">Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_books as $book)
            <tr>
              <td>
                <a href="{{ route('book.preview', ['id' => $book->id]) }}">{{ $book->title }}</a>
              </td>
              <td>
                {{ $book->author->name }}
              </td>
              <td>
                {{ $book->isbn }}
              </td>
              <td>
                @if($book->cover)
                  <img src="{{ asset('/storage/images/' . $book->cover) }}" alt="{{ $book->cover }}" class="img-fluid" style="max-width: 100px;">
                @endif
              </td>
              <td>
                <span title="{{ $book->created_at }}">{{ $book->created_at->diffForHumans() }}</span>
              </td>
              <td class="text-end">
                <a href="{{ route('book.edit', ['id' => $book->id]) }}" class="text-warning"><i class="fa-solid fa-file-pen"></i></a>
              </td>
              <td>
                <a href="{{ route('book.show', ['id' => $book->id]) }}" class="text-danger"><i class="fa-solid fa-trash-can"></i></a>
              </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-center mt-3">
    {{ $all_books->links() }}
  </div>
@endif
</div>
@endsection
