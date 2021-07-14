@extends('panel.pages.layout', ['title' => 'Category Edit Page'])
@section('content')

    <form method="POST" action="{{route('panel.category.update', ['category' => $category])}}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="categoryName">Category Name:</label>
            <input class="form-control" value="{{$category->name}}" type="text" name="categoryName" id="categoryName"/>
            @error('categoryName')
            {{$message}}
            @enderror
        </div>
        <input class="form-control" type="submit" value="Edit"/>
    </form>
@endsection