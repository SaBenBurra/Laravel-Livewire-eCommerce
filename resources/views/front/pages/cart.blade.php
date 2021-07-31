@extends('front.pages.layout', ['title' => 'Cart'])
@section('content')
    <section class="section-content padding-y">
        <div class="container">

            @livewire('front.cart')

        </div> <!-- container .//  -->
    </section>
@endsection