@extends('panel.pages.layout', ['title' => 'Category Creation Page'])
@section('content')

    <form method="POST" action="{{route('panel.category.store')}}">
        @csrf
        <div class="form-group">
            <label for="categoryName">Category Name:</label>
            <input class="form-control" type="text" name="name" id="categoryName"/>
            @error('name')
            {{$message}}
            @enderror
        </div>
        <div class="form-group">
            <label for="slug">Slug:</label>
            <input class="form-control" type="text" name="slug" id="slug"/>
            @error('slug')
            {{$message}}
            @enderror
        </div>
        <input class="form-control" type="submit" value="Create"/>
    </form>
@endsection