@extends('panel.pages.layout', ['title' => 'Brands'])
@section('content')
    <h1 class="h3">Brands</h1>

    <a href="{{route('panel.brand.create')}}">
        <button class="btn btn-success mb-4 mt-4">Add New</button>
    </a>

    <livewire:tables.brand-datatable/>
@endsection