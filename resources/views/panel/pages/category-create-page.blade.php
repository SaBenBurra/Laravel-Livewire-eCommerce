@extends('panel.pages.layout', ['title' => 'Category Creation Page'])
@section('content')

    <form method="POST" action="{{route('panel.category.store')}}">
        @csrf
        <div class="form-group">
            <label for="categoryName">Category Name:</label>
            <input class="form-control" type="text" name="categoryName" id="categoryName"/>
            @error('categoryName')
                {{$message}}
            @enderror
        </div>
        <input class="form-control" type="submit" value="Create"/>
    </form>
@endsection