@extends('layouts.app')

@section('title', 'Library | Book Preview')

@section('content')
<div class="container mt-3">
  <div class="card w-75 mx-auto">
    <div class="card-header d-flex justify-content-between">
      <span class="text-start h4">Book Preview</span>
      <div>
        <a href="{{ route('book.create') }}" class="btn btn-warning ms-auto">Back</a>
        <a href="{{ route('book.edit', ['id' => $book->id]) }}" class="btn btn-warning">Edit this book</a>
      </div>
    </div>

    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          @if ($book->cover)
            <img src="{{ asset('/storage/images/' . $book->cover) }}" alt="{{ $book->cover }}" class="img-fluid">
          @else
            <i class="fas fa-book fa-5x"></i>
          @endif
        </div>
        <div class="col-md-8">
          <h3>{{ $book->title }}</h3>
          <p class="fw-bold">by {{ $author->name }}</p>
          <p>Published in {{ $book->yearPublished }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
