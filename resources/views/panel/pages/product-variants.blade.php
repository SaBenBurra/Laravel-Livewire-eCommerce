@extends('panel.pages.layout', ['title' => 'Product Variants'])
@section('content')
    @livewire('panel.product-variants', ['product' => $product])
@endsection