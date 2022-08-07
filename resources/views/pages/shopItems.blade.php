  {{-- Css --}}
  
  @include('layouts.styles')
        
<div class="row mb-4">
    @isset($products)
    @foreach ($products as $product)
        <div class="col-md-3 col-sm-6 col-xs-6 col-6 mb-4">
            <div class=" product-card card item-card-{{$product->uuid}}">
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

                        @if($product->out_of_stock == 1)
                        <button type="submit" class="btn btn-block  btn-primary  rounded-0 py-1 btn-cart-item" disabled>
                           Out Of Stock
                        </button>
                        @else
                          <button type="button" class="btn btn-block btn-primary rounded-0 py-1 btn-cart-item"  onclick="addtocart('{{$product->uuid}}')">
                            Add To Cart
                        </button>
                        @endif
                      
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    @endisset
</div>

 {{-- Js --}}
 
 @include('layouts.scripts')
