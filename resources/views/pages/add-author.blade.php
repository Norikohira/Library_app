@extends('layouts.app')

@section('title', 'Library | Add Author')

@section('content')
<div class="container">
  <h2>Authors</h2>
  <form action="{{ route('author.store') }}" method="post">
    @csrf

    <div class="row">
      <div class="col-md-8">
        <input type="text" name="name" placeholder="Add new author" class="form-control">
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-success form-control">+ Add</button>
      </div>
    </div>
  </form>

  <div class="row">
    <div class="col-md-10">
      @if($all_authors->isEmpty())
        <p>No authors yet</p>
      @else
        <table class="table table-white table-hover mt-3">
          @foreach($all_authors as $author)
            <tr>
              <td>{{ $author->name }}</td>
              <td class="text-end">
                <a href="{{ route('author.edit', ['id' => $author->id]) }}" class="text-warning"><i class="fa-solid fa-file-pen"></i></a>
              </td>
              <td>
                <a href="{{ route('author.show', ['id' => $author->id]) }}" class="text-danger"><i class="fa-solid fa-trash-can"></i></a>
              </td>
            </tr>
          @endforeach
        </table>
      @endif
    </div>
  </div>
</div>
@endsection
