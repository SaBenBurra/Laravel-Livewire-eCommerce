@extends('panel.pages.layout', ['title' => 'Product Property Values'])
@section('content')
    @livewire('panel.product-property-values', ['productPropertyName' => $productPropertyName])
@endsection