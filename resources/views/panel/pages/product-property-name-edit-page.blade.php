@extends('panel.pages.layout', ['title' => 'Product Property Name Edit'])
@section('content')
    <form action="{{route('panel.productPropertyName.update', [$productPropertyName])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="productPropertyName" class="form-text">Product Property Name:</label>
            <input type="text" class="form-control" value="{{$productPropertyName->name}}" name="name"
                   id="productPropertyName"/>
            @error('name')
            {{$message}}
            @enderror
        </div>
        <input type="submit" class="form-control" value="Edit"/>
    </form>
@endsection