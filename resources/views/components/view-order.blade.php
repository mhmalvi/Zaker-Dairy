@extends('layouts.app')

@section('content')

<!-- Breadcrumb Area Start Here -->
<div class="breadcrumbs-area position-relative" style="background-image: url({{asset('assets/img/banner/3.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="breadcrumb-content position-relative section-content">
                    <h3 class="title-3 text-light">My Account</h3>
                    <ul>
                        <li><a href="{{route('index')}}">Home</a></li>
                        <li>My Account - Order View</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End Here -->
<!-- my account wrapper start -->
<div class="my-account-wrapper mt-no-text mb-no-text" style="margin-bottom: 7rem;">
    <div class="container container-default-2 custom-area">
        <div class="row">
            <div class="col-lg-12 col-custom">
                   <div class="myaccount-content">

                        <p class="mb-1">Orders No- {{ $order->id }}</p>
                        <p class="mb-1">Orders Uuid- {{ $order->uuid }}</p>
                        <p class="mb-1">Orders Date- {{ $order->created_at }}</p>
                        <p class="mb-1">Orders Shipping- {{ $order->shipping_details }}</p>
                        <p class="mb-1">Orders Status- {{ $order->status }}</p>
                        <h6 class="mb-1">Total Amount- {{ $order->total }}</h6>


                       <div class="myaccount-table table-responsive text-center mt-3">
                           <table class="table table-bordered">
                               <thead class="thead-light">
                                   <tr>
                                       <th>Product Name</th>
                                       <th>Quantity</th>
                                       <th>Price</th>
                                       <th>Unit</th>
                                       <th>Photo</th>
                                   </tr>
                               </thead>
                               <tbody>
                               @isset($orderItems)
                                      @foreach ($orderItems as $item)
                                      <tr>
                                          <td>{{$item->product->name}}</td>
                                          <td>{{$item->qty}}</td>
                                          <td>
                                              {{$item->product->price}}
                                          </td>
                                          <td>{{$item->product->unit}}</td>
                                          <td><img src="{{ asset('storage/app/public/products/'.$item->product->thumbnail) }}" width="65px" height="65px"></td>

                                      </tr>

                                      @endforeach

                               @endisset
                                 
                               </tbody>
                           </table>
                       </div>
                   </div>

            </div>
        </div>
    </div>
</div>
<!-- my account wrapper end -->
@endsection

