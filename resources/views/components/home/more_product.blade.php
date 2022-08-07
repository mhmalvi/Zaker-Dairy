<div class="col-6 col-xs-6 col-sm-6 col-md-3 px-1 pb-3 ">
    <div class="product-card card item-card-{{$product->uuid}}">
        <div class="item-img">
            <img class="card-img-top" src="{{asset('storage/app/public/products/'.$product->thumbnail)}}" alt="{{$product->alt ?? $product->name}}" alt="Card image cap">
        </div>
        <div class="card-body item-card">
            <p><a href="{{!is_null($product->category_id) ? route('item', [$product->category->slug, $product->slug]) : ''}}">{{$product->name}}</a> </p>
            <div class="price py-1">
                <p><strong>BDT- </strong>{{__($product->price)}} / <small>1 Kg</small></p>
            </div>
            <form  class="product py-2">
                <div class="quantity mx-0">
                    <div class="cart-plus-minus w-100">
                        <input class="cart-plus-minus-box w-100" value="1" type="text" id="item-{{$product->uuid}}">
                        <div class="dec qtybutton">-</div>
                        <div class="inc qtybutton">+</div>
                    </div>
                </div>
                <button type="button" class="btn btn-block btn-primary rounded-0 py-1 btn-cart-item" onclick="addtocart('{{$product->uuid}}')">
                    Add To Cart
                </button>
            </form>
        </div>
    </div>
</div>
