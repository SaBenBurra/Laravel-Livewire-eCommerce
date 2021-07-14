@extends('panel.pages.layout', ['title' => 'Categories'])
@section('content')
    <h1 class="h3">Categories</h1>

    <a href="{{route('panel.category.create')}}"><button class="btn btn-success mb-4 mt-4">Add New</button></a>

    <livewire:tables.category-datatable/>
@endsection