@extends('panel.pages.layout', ['title' => "Product Images {$product->title}"])
@section('content')
    product images

    @livewire('panel.product-images', ['product' => $product])

@endsection

@section('custom-js')
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
@endsection