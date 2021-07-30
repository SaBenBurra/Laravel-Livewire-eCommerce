@extends('front.pages.layout', ['title' => $product->name])
@section('content')
    <script>
        window.addEventListener("alert", (e) => {
            alert(e.detail.text)
        })
    </script>
    <div class="container">
        @livewire('front.product-detail', ['product' => $product])
    </div>
@endsection