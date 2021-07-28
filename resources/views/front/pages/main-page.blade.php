@extends('front.pages.layout', ['title' => 'Main Page'])
@section('content')
    <div class="container">

        <div class="row">
            <aside class="col-md-3">
                <nav class="card">
                    <ul class="menu-category">
                        <li><a href="#">Best clothes</a></li>
                        <li><a href="#">Automobiles</a></li>
                        <li><a href="#">Home interior</a></li>
                        <li><a href="#">Electronics</a></li>
                        <li><a href="#">Technologies</a></li>
                        <li><a href="#">Digital goods</a></li>
                        <li class="has-submenu"><a href="#">More items</a>
                            <ul class="submenu">
                                <li><a href="#">Submenu name</a></li>
                                <li><a href="#">Great submenu</a></li>
                                <li><a href="#">Another menu</a></li>
                                <li><a href="#">Some others</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </aside> <!-- col.// -->
            <div class="col-md-9">
                <article class="banner-wrap">
                    <img src="{{asset('vendor/front/images/banner.jpg')}}" class="w-100 rounded">
                </article>
            </div> <!-- col.// -->
        </div> <!-- row.// -->
    </div> <!-- container //  -->

    <section class="section-name padding-y-sm">
        <div class="container">

            <header class="section-heading">
                <a href="#" class="btn btn-outline-primary float-right">See all</a>
                <h3 class="section-title">Popular products</h3>
            </header><!-- sect-heading -->


            <div class="row">
                @forelse($lastProducts as $product)
                <div class="col-md-3">
                    <div href="#" class="card card-product-grid">
                        <a href="#" class="img-wrap"> <img src="{{$product->coverImagePath()}}"> </a>
                        <figcaption class="info-wrap">
                            <a href="#" class="title">{{$product->name}}</a>
                            <div class="price mt-1">${{$product->price}}</div> <!-- price-wrap.// -->
                        </figcaption>
                    </div>
                </div> <!-- col.// -->
                    @empty
                    There is no products
                @endforelse
            </div> <!-- row.// -->

        </div><!-- container // -->
    </section>
    <!-- ========================= SECTION  END// ========================= -->

@endsection