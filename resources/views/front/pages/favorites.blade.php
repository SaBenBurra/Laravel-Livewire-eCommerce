@extends('front.pages.layout', ['title' => 'Favorites'])
@section('content')
    <section class="section-content padding-y">
        <div class="container">
            <div class="row">
                <main class="col-md-9">
                    <div class="card">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                            <tr class="small text-uppercase">
                                <th scope="col">Product</th>
                                <th scope="col" class="text-right" width="200">Button</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($favoriteProducts as $favoriteProduct)
                                <tr>
                                    <td>
                                        <figure class="itemside">
                                            <div class="aside">
                                                <img src="{{$favoriteProduct->product->coverImagePath()}}"
                                                     class="img-sm"/>
                                            </div>
                                            <figcaption class="info">
                                                <a href="{{route('front.productDetail', [$favoriteProduct->product->slug])}}"
                                                   class="title text-dark">{{$favoriteProduct->product->name}}</a>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td>
                                        @livewire('front.favorite-button', ['product' => $favoriteProduct->product])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- card.// -->
                </main> <!-- col.// -->
            </div>
        </div> <!-- container .//  -->
    </section>
@endsection