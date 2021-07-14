@extends('panel.pages.layout', ['title' => 'Brand Creation Page'])
@section('content')

    <form method="POST" action="{{route('panel.brand.store')}}">
        @csrf
        <div class="form-group">
            <label for="brandName">Brand Name:</label>
            <input class="form-control" type="text" name="brandName" id="brandName"/>
            @error('brandName')
            {{$message}}
            @enderror
        </div>
        <input class="form-control" type="submit" value="Create"/>
    </form>
@endsection