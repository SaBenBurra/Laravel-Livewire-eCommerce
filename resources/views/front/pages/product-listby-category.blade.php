@extends('front.pages.layout', ['title' => 'product-list'])
@section('content')
    <section class="section-pagetop bg">
        <div class="container">
            <h2 class="title-page">{{$category->name}}</h2>
        </div> <!-- container //  -->
    </section>
    <div class="container mt-5">
        <header class="border-bottom mb-4 pb-3">
            <div class="form-inline">
                <span class="mr-md-auto">{{$products->count()}} Items found </span>
                <select class="mr-2 form-control">
                    <option>Latest items</option>
                    <option>Trending</option>
                    <option>Most Popular</option>
                    <option>Cheapest</option>
                </select>
                <div class="btn-group">
                    <a href="#" class="btn btn-outline-secondary" data-toggle="tooltip" title="List view">
                        <i class="fa fa-bars"></i></a>
                    <a href="#" class="btn  btn-outline-secondary active" data-toggle="tooltip" title="Grid view">
                        <i class="fa fa-th"></i></a>
                </div>
            </div>
        </header><!-- sect-heading -->

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3">
                    <figure class="card card-product-grid">
                        <div class="img-wrap">
                            <a href="{{route('front.productDetail', [$product->slug])}}"><img
                                        src="{{$product->coverImagePath()}}"></a>
                            <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
                        </div> <!-- img-wrap.// -->
                        <figcaption class="info-wrap">
                            <div class="fix-height">
                                <a href="{{route('front.productDetail', [$product->slug])}}"
                                   class="title">{{$product->name}}</a>
                                <div class="price-wrap mt-2">
                                    <span class="price">${{$product->price}}</span>
                                </div> <!-- price-wrap.// -->
                            </div>
                            <a href="#" class="btn btn-block btn-primary">Add to cart </a>
                        </figcaption>
                    </figure>
                </div> <!-- col.// -->
            @endforeach
        </div> <!-- row end.// -->
        {{$products->links()}}
    </div>
@endsection