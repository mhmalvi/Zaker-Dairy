<div class="container-fluid">
    <div class="row">
        <div class=" col-12 col-lg-6 col-md-6 text-center">
            <div class="product-image">
                <img src="{{asset('storage/products/'.$product->thumbnail)}}" alt="Product Image">
            </div>
        </div>
        <div class="col-12 col-lg-6 col-md-6">
            <div class="modal-product">
                <div class="product-content">
                    <div class="product-title">
                        <h4 class="title">{{$product->name}}</h4>
                    </div>
                    <div class="price-box">
                        <span class="regular-price ">
                            Regular Price:&nbsp;
                            {{$product->price}}
                        </span>
                        {{-- <span class="old-price"><del>$90.00</del></span> --}}
                    </div>
                    <p class="desc-content">
                        {{$product->description }}
                    </p>
                        <div class="quantity-with_btn">
                            <form action="{{route('add.cart', $product->uuid)}}" method="post" id="addToCart">
                            @csrf
                                <div class="quantity">
                                    <div class="cart-plus-minus">
                                        <input 
                                            type="text" 
                                            name="qty" 
                                            class="cart-plus-minus-box"
                                            value="1" 
                                        />
                                    </div>
                                </div>
                            </form>
                            <div class="add-to_cart">
                                <a class="btn obrien-button primary-btn" href="javascript:void(0)" onclick="document.getElementById('addToCart').submit()">Add to cart</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>