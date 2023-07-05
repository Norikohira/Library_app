@extends('layouts.app')

@section('title', 'Library | Dashboard')

@section('content')
<div class="d-flex justify-content-center align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-3">
        <div class="border bg-white rounded-lg">
          <a href="{{ route('author.create') }}" class="text-primary text-center h1 m-5 fw-bold" style="text-decoration: none; display: block;">Authors {{ $authorCount }}</a>
        </div>
      </div>

      <div class="col-3">
        <div class="border bg-white rounded-lg">
          <a href="{{ route('book.create') }}" class="text-success text-center h1 m-5 fw-bold" style="text-decoration: none; display: block;">Books {{ $bookCount }}</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection