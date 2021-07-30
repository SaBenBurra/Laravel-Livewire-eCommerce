<header class="section-header">
    <section class="header-main border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-4">
                    <div class="brand-wrap">
                        <img class="logo" src="{{asset('vendor/front/images/logo.png')}}">
                    </div> <!-- brand-wrap.// -->
                </div>
                <div class="col-lg-6 col-sm-12 order-3 order-lg-2">
                    <form action="#">
                        <div class="input-group w-100">
                            <input type="text" class="form-control" placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form> <!-- search-wrap .end// -->
                </div> <!-- col.// -->
                <div class="col-lg-4 col-sm-6 col-8 order-2 order-lg-3">
                    <div class="float-md-right">
                        @auth
                        <div class="widget-header  mr-3">
                            @livewire('front.cart-icon')
                        </div>
                        @endauth
                        <div class="widget-header icontext">
                            @auth
                            <a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
                            @endauth
                            <div class="text">
                                <span class="text-muted">Welcome!</span>
                                @auth
                                    {{auth()->user()->name}}
                                    <form style="display:inline" action="{{route('logout')}}" method="POST">
                                        @csrf
                                        <input type="submit" value="Logout" />
                                    </form>
                                @endauth
                                @guest
                                <div>
                                    <a href="{{route('login')}}">Sign in</a> |
                                    <a href="{{route('register')}}"> Register</a>
                                </div>
                                @endguest
                            </div>
                        </div>

                    </div> <!-- widgets-wrap.// -->
                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- container.// -->
    </section> <!-- header-main .// -->
</header> <!-- section-header.// -->