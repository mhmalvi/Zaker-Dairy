@if (Session::has('cart'))
    <div class="mini-cart-wrapper">
        @foreach (Session::get('cart')->items as $item)
            <div class="single-cart-item">
                <div class="cart-img">
                    <a href="javascript:void(0)">
                        <img src="https://zakerdairyfarm.com//storage/app/public/products/{{ $item['item']['thumbnail'] }}" alt="">
                    </a>
                </div>
                <div class="cart-text">
                    <h5 class="title">
                        <a href="javascript:void(0)">{{$item['item']['name']}}</a>
                    </h5>
                    <div class="cart-text-btn">
                        <div class="cart-qty">
                            <span>{{$item['qty']}}×</span>
                            <span class="cart-price">{{$item['item']['price']}}&nbsp;tk</span>
                        </div>
                        <a href="{{route('item.remove', $item['item']['uuid'])}}">
                            <i class="ion-trash-b"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="cart-price-total d-flex justify-content-between">
        <h5>Total :</h5>
        <h5>{{Session::get('cart')->totalPrice}}&nbsp;tk</h5>
    </div>
    <div class="cart-links d-flex justify-content-center">
        <a class="obrien-button white-btn" href="{{route('cart')}}" style="font-size:15px">View cart</a>
        <a class="obrien-button white-btn" href="{{route('checkout')}}" style="font-size:15px">Checkout</a>

    </div>
@else
    <p class="text-center text-secondary">Your cart is empty!</p>
@endif
