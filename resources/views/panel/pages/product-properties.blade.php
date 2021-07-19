@extends('panel.pages.layout', ['title' => 'Product Properties'])
@section('content')
    @livewire('panel.product-properties', ['product' => $product])
@endsection