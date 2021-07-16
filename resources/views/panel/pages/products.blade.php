@extends('panel.pages.layout', ['title' => 'Products'])
@section('content')
    <h1 class="h3">Products</h1>

    <a href="{{route('panel.product.create')}}"><button class="btn btn-success mb-4 mt-4">Add New</button></a>

    <livewire:tables.product-datatable />
@endsection