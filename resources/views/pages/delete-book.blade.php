@extends('layouts.app')

@section('title', 'Library | Delete Book')

@section('content')
<div class="container">
  <h2 class="text-center text-danger"><i class="fa-solid fa-triangle-exclamation"></i> Delete Book</h2>
  <p class="text-center">Are you sure you want to delete <span class="fw-bold">{{$book->title}}</span> ?</p>
  <form action="{{ route('book.destroy', $book->id) }}" method="post">
    @csrf
    @method('DELETE')

    <div class="row mt-3">
      <div class="col-md-2"></div>
      <div class="col-md-4">
        <a href="{{ route('book.create') }}" class="btn btn-outline-danger form-control">Cancel</a>
      </div>
      <div class="col-md-4">
        <button type="submit" class="btn btn-danger form-control">Delete</button>
      </div>
    </div>
  </form>
</div>
@endsection
