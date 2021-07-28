@extends('front.pages.layout', ['title' => $product->name])
@section('content')
    <div class="container">
        @livewire('front.product-detail', ['product' => $product])
    </div>
@endsection