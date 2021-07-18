@extends('panel.pages.layout', ['title' => 'Product Properties'])
@section('content')
    <h1 class="h3">Product Properties</h1>
    <a href="{{route('panel.productPropertyName.create')}}">
        <button class="btn btn-success mb-4 mt-4">Add New</button>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Edit</th>
            <th scope="col">Remove</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productPropertyNames as $productPropertyName)
            <tr>
                <td>{{$productPropertyName->id}}</td>
                <td>{{$productPropertyName->name}}</td>
                <td>
                    <a href="{{route('panel.productPropertyName.edit', $productPropertyName)}}">
                        <button class="btn btn-success">Edit</button>
                    </a>
                </td>
                <td>
                    <form method="POST" action="{{route('panel.productPropertyName.destroy', [$productPropertyName])}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Are You Sure?')">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection