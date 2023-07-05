@extends('layouts.app')

@section('title', 'Library | Edit Book')

@section('content')
<div class="container">
  <div class="justify-content-center">
    <div class="row">
      <h3>Edit Book</h3>
    </div>
    <div class="row">
      <div class="col-md-4">
        @if ($book->cover)
          <img src="{{ asset('/storage/images/' . $book->cover) }}" alt="{{ $book->cover }}" class="img-fluid">
        @else
          <i class="fas fa-book fa-5x"></i>
        @endif
      </div>
      <div class="col-md-8">
        <form action="{{ route('book.update', ['id' => $book->id]) }}" method="post" enctype="multipart/form-data">
          @csrf
          @method('PATCH')

          <div class="row">
            <div class="col-md-8">
              <label for="title">Title</label>
              <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title here" value="{{ old('title', $book->title) }}" autofocus>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-4">
              <label for="yearPublished">Year Published</label>
              <input type="number" name="yearPublished" id="yearPublished" class="form-control" placeholder="YYYY" value="{{ old('yearPublished', $book->yearPublished) }}">
            </div>
            <div class="col-md-4">
              <label for="author">Author</label>
              <select name="author" class="form-control">
                <option value="null">ANONIMOUS</option>
                @foreach($all_authors as $author)
                  <option value="{{ $author->id }}" {{ ($author->id == $book->author_id) ? 'selected' : '' }}>{{ $author->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-8">
              <label for="isbn">ISBN</label>
              <input type="text" name="isbn" id="isbn" class="form-control" placeholder="Add ISBN" value="{{ old('isbn', $book->isbn) }}">
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-8">
              <label for="cover">Cover (optional)</label>
              <input type="file" name="cover" id="cover" class="form-control">
              <div class="form-text" id="image-info">
                Acceptable formats: jpeg, jpg, png, gif only<br>
                Maximum file size: 1048kb
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-4">
              <a href="{{ route('book.preview', ['id' => $book->id]) }}" class="btn btn-outline-warning form-control">Cancel</a>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-warning form-control">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
