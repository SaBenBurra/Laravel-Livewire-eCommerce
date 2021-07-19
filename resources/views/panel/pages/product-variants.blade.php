@php
    $a = 5;    
@endphp

@extends('panel.pages.layout', ['title' => 'Product Variants'])
@section('content')
    <h1>{{$product->name}}</h1>
    <p>{{$a}}</p>
@endsection