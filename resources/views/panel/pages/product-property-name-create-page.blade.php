@extends('panel.pages.layout', ["title" => "Product Property Name Creation"])
@section('content')
    <form action="{{route('panel.productPropertyName.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="productPropertyName" class="form-text">Product Property Name:</label>
            <input type="text" class="form-control" name="name" id="productPropertyName"/>
            @error('name')
            {{$message}}
            @enderror
        </div>
        <input type="submit" class="form-control" value="Create"/>
    </form>
@endsection