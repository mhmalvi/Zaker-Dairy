@extends('layouts.app')

@section('content')
@php 
 $background = App\Models\Background::where('background_type','cart_page')->first();
@endphp
    <!-- Breadcrumb Area Start Here -->
    @if($background)
    <div class="breadcrumbs-area position-relative" style="background-image: url({{asset('assets/admin/img/background-image/'.$background->background)}});">
    @else
    <div class="breadcrumbs-area position-relative" style="background-image: url({{asset('assets/admin/img/background-image/demo-background.jpg')}});">
    @endif
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3 text-light">Shopping Cart</h3>
                        <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper mt-no-text mb-no-text">
        <div class="container container-default-2 custom-area">
            @if (Session::has('cart'))
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Cart Table Area -->
                        <form action="{{route('qty.update')}}" method="post" id="cartUpdate">
                            @csrf
                            <div class="cart-table table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr class="table-light">
                                            <th class="pro-title" colspan="2">Product</th>
                                            <th class="pro-price">Price</th>
                                            <th class="pro-quantity">Quantity</th>
                                            <th class="pro-subtotal">Total</th>
                                            <th class="pro-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $item)
                                            <tr>
                                                <td class="pro-thumbnail">
                                                    <a href="">
                                                        <img class="img-fluid" src="{{asset('storage/app/public/products/'.$item['item']['thumbnail'])}}" alt="{{$item['item']['product_name']}}" />
                                                    </a>
                                                </td>
                                                <td class="pro-title"><a href="">{{$item['item']['name']}}</a></td>
                                                <td class="pro-price"><span>{{$item['item']['price']}}&nbsp;tk</span></td>
                                                <td class="pro-quantity">
                                                    <input type="hidden" name="item_id[]" value="{{$item['item']['id']}}">
                                                    <div class="quantity">
                                                        <div class="cart-plus-minus">
                                                            <input class="cart-plus-minus-box" name="qty[]" value="{{($item['qty']) ? $item['qty'] : '0'}}" type="number">
                                                            <div class="dec qtybutton">-</div>
                                                            <div class="inc qtybutton">+</div>
                                                            <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                                            <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="pro-subtotal"><span>{{($item['item']['price']) * ($item['qty'])}}&nbsp;tk</span></td>
                                                <td class="pro-remove">
                                                    <a href="{{route('item.remove', $item['item']['uuid'])}}"><i class="ion-trash-b"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <!-- Cart Update Option -->
                        <div class="cart-update-option d-block d-flex justify-content-end border-0">
                            <div class="cart-update mt-sm-16 mr-3">
                                <form action="{{route('cart.destroy')}}" method="post" id="destroyCart">
                                    @csrf
                                    @method('delete')
                                </form>
                                <button type="button" class="btn obrien-button btn-light" onclick="event.preventDefault(); document.getElementById('destroyCart').submit();">
                                    Clear Cart
                                </button>
                            </div>
                            <div class="cart-update mt-sm-16">
                                <button type="button" class="btn obrien-button primary-btn" onclick="event.preventDefault(); document.getElementById('cartUpdate').submit();">
                                    Update Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h3>Cart Totals</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Sub Total</td>
                                            <td>{{$totalPrice}}&nbsp;tk</td>
                                        </tr>
                                        {{-- <tr>
                                            <td>Shipping</td>
                                            <td>$70</td>
                                        </tr> --}}
                                        <tr class="total">
                                            <td>Total</td>
                                            <td class="total-amount">{{$totalPrice}}&nbsp;tk</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <a href="{{route('checkout')}}" class="btn obrien-button primary-btn d-block">Proceed To Checkout</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="d-flex justify-content-center">
                    <img src="{{asset('assets/empty.svg')}}" alt="Your cart is empty" style="max-width: 350px;">
                </div>
                <h2 class="text-center p-5" style="color: #444053;">Your cart is empty!!!</h2>
                <div class="d-flex justify-content-center">
                    <a href="{{route('shop')}}" class="btn obrien-button primary-btn">Continue Shopping</a>
                </div>
            @endif
        </div>
    </div>
    <!-- cart main wrapper end -->
@endsection
