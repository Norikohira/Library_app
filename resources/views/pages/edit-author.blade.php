@extends('layouts.app')

@section('title', 'Library | Edit Author')

@section('content')
<div class="container">
  <h2>Edit Authors</h2>
  <form action="{{ route('author.update', $author->id) }}" method="post">
    @csrf
    @method('PATCH')

    <div class="row">
      <div class="col-md-10">
        <input type="text" name="name" placeholder="Author name" class="form-control" value="{{ $author->name }}">
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-5">
        <a href="{{ route('author.create') }}" class="btn btn-outline-warning form-control">Cancel</a>
      </div>
      <div class="col-md-5">
        <button type="submit" class="btn btn-warning form-control">Update</button>
      </div>
    </div>
  </form>
</div>
@endsection
