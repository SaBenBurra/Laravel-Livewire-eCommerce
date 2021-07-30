<div>
    <div class="card mt-5">
        <div class="row no-gutters">
            <aside class="col-md-6">
                <article class="gallery-wrap">
                    <div class="img-big-wrap">
                        <div><a href="#"><img src="{{asset($product->images[0]->path)}}"></a></div>
                    </div> <!-- slider-product.// -->
                    <div class="thumbs-wrap">
                        @foreach($product->images as $image)
                            <a href="#" class="item-thumb"><img src="{{asset($image->path)}}"></a>
                        @endforeach
                    </div> <!-- slider-nav.// -->
                </article> <!-- gallery-wrap .end// -->
            </aside>
            <main class="col-md-6 border-left">
                <article class="content-body">

                    <h2 class="title">{{$product->name}}</h2>

                    <div class="rating-wrap my-3">
                        <ul class="rating-stars">
                            <li style="width:80%" class="stars-active">
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                            <li>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                        </ul>
                        <small class="label-rating text-muted">132 reviews</small>
                        <small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> 154 orders
                        </small>
                    </div> <!-- rating-wrap.// -->

                    <div class="mb-3">
                        <var class="price h4">${{$product['price']}}</var>
                    </div> <!-- price-detail-wrap .// -->

                    <p>{{$product['description']}}</p>


                    <hr>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Quantity</label>
                            <div class="input-group mb-3 input-spinner">
                                <div class="input-group-prepend">
                                    <button class="btn btn-light" wire:click="increaseQuantity" type="button"
                                            id="button-plus">+
                                    </button>
                                </div>
                                <input type="text" class="form-control" value="{{$quantity}}">
                                <div class="input-group-append">
                                    <button class="btn btn-light" wire:click="decreaseQuantity" type="button"
                                            id="button-minus">&minus;
                                    </button>
                                </div>
                            </div>
                        </div> <!-- col.// -->
                    </div> <!-- row.// -->

                    @foreach($variantGroups as $variantGroupIndex => $variantGroup)
                        <div class="form-row" wire:key="variantGroup_{{ $variantGroupIndex }}">
                            <div class="form-group col-md">
                                <label>{{$variantGroup[0]['name']['name']}}</label>
                                <div class="mt-1">
                                    <select wire:model="idsOfSelectedVariants.{{$variantGroup[0]['property_name_id']}}">
                                        @foreach($variantGroup as $variant)
                                            <option value="{{$variant['id']}}">{{$variant['value']['value']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> <!-- col.// -->
                        </div>
                    @endforeach

                    <a wire:click.prevent="addToCart" class="btn  btn-primary">Add to cart <i
                                class="fas fa-shopping-cart"></i></a>
                </article> <!-- product-info-aside .// -->
            </main> <!-- col.// -->
        </div> <!-- row.// -->
    </div> <!-- card.// -->
</div>
