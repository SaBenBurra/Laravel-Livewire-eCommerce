<div>
    <div class="row">
        <main class="col-md-9">
            <div class="card">
                <table class="table table-borderless table-shopping-cart">
                    <thead class="text-muted">
                    <tr class="small text-uppercase">
                        <th scope="col">Product</th>
                        <th scope="col" width="120">Quantity</th>
                        <th scope="col" width="120">Price</th>
                        <th scope="col" class="text-right" width="200"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cartItems as $cartItem)
                        <tr wire:key="cartitem{{$cartItem->id}}">

                            <td>
                                <figure class="itemside">
                                    <div class="aside"><img src="{{$cartItem->product->coverImagePath()}}"
                                                            class="img-sm"></div>
                                    <figcaption class="info">
                                        <a href="{{route('front.productDetail', [$cartItem->product->slug])}}"
                                           class="title text-dark">{{$cartItem->product->name}}</a>
                                        <p class="text-muted small">
                                            @foreach($cartItem->variants() as $variant)
                                                {{$variant->name->name}}: {{$variant->value->value}} <br>
                                            @endforeach
                                        </p>
                                    </figcaption>
                                </figure>
                            </td>
                            <td>
                                @livewire('front.cart-item-quantity', ['cartItem' => $cartItem])

                            </td>
                            <td>
                                <div class="price-wrap">
                                    <var class="price">
                                        @livewire('front.cart-item-price', ['cartItem' => $cartItem])
                                    </var>
                                    <small class="text-muted"> ${{$cartItem->price()}} each </small>
                                </div> <!-- price-wrap .// -->
                            </td>
                            <td class="text-right">
                                <a data-original-title="Save to Wishlist" title="" href="" class="btn btn-light"
                                   data-toggle="tooltip"> <i class="fa fa-heart"></i></a>
                                <a href="" class="btn btn-light" wire:click.prevent="removeItem({{$cartItem->id}})"> Remove</a>
                            </td>
                            {{--                            <livewire:cart-item :cartItem="{{$cartItem}}" :wire:key="cart_item{{$cartItem->id}}"/>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="card-body border-top">
                    <a href="#" class="btn btn-primary float-md-right"> Make Purchase <i
                                class="fa fa-chevron-right"></i> </a>
                    <a href="#" class="btn btn-light"> <i class="fa fa-chevron-left"></i> Continue shopping </a>
                </div>
            </div> <!-- card.// -->

            <div class="alert alert-success mt-3">
                <p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks
                </p>
            </div>

        </main> <!-- col.// -->
        <aside class="col-md-3">
            <div class="card mb-3">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label>Have coupon?</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="" placeholder="Coupon code">
                                <span class="input-group-append">
											<button class="btn btn-primary">Apply</button>
										</span>
                            </div>
                        </div>
                    </form>
                </div> <!-- card-body.// -->
            </div>  <!-- card .// -->
            <div class="card">
                <div class="card-body">
                    <dl class="dlist-align">
                        <dt>Total price:</dt>
                        <dd class="text-right">USD 568</dd>
                    </dl>
                    <dl class="dlist-align">
                        <dt>Discount:</dt>
                        <dd class="text-right">USD 658</dd>
                    </dl>
                    <dl class="dlist-align">
                        <dt>Total:</dt>
                        <dd class="text-right  h5"><strong>$1,650</strong></dd>
                    </dl>
                    <hr>
                    <p class="text-center mb-3">
                        <img src="images/misc/payments.png" height="26">
                    </p>

                </div> <!-- card-body.// -->
            </div>  <!-- card .// -->
        </aside> <!-- col.// -->
    </div>
</div>
