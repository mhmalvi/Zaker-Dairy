
@extends('layouts.app')

@push('css')
<style>
            .bkash{
                margin-right:120px;
                font-size:20px;
            }
           .bkash img{
              
                height: 150px;
                width: 150px;
              
                    }
</style>
@endpush

@section('content')
    <!-- Breadcrumb Area Start Here -->
   @if($background)
    <div class="breadcrumbs-area position-relative" style="background-image: url({{asset('assets/admin/img/background-image/'.$background->background)}});">
    @else
    <div class="breadcrumbs-area position-relative" style="background-image: url({{asset('assets/admin/img/background-image/demo-background.jpg')}});">
    @endif
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content" />
                        <h3 class="title-3 text-light">Checkout</h3>
                        <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Checkout Area Start Here -->
    <div class="checkout-area">
        <div class="container container-default-2 custom-container">
            @if(!auth()->check())
                <div class="row">
                    <div class="col-12">
                        <div class="coupon-accordion">
                            <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                            <div id="checkout-login" class="coupon-content"
                                @if(count($errors))
                                    style="display: block"
                                @endif
                                >
                                <div class="coupon-info">
                                    <form action="{{ route('checkout.login') }}" method="post">
                                        @csrf
                                        <p class="form-row-first">
                                            <label>Username or email <span class="required">*</span></label>
                                            <input type="email" name="checkout_login_email">
                                            @error('checkout_login_email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                        <p class="form-row-last">
                                            <label>Password <span class="required">*</span></label>
                                            <input type="password" name="checkout_login_password">
                                            @error('checkout_login_password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </p>
                                        <p class="lost-password"><a href="{{ route('password.request') }}">Lost your password?</a></p>
                                        <div class="single-input-item mb-3">
                                            <button type="submit" class="btn obrien-button-2 primary-color">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            @endif

            <checkout-form-component user_is_auth="{{ auth()->check() ? '1' : '0' }}"
                total_price="{{ $totalPrice }}"
                user="{{ json_encode($user) }}"
                data="{{ json_encode($products) }}" />
                
              
        </div>
        <div class="container">
             <div class="row">
                    <div class="col-md-6"></div>
                        <div class="col-md-6 text-right">
                            <div class="bkash">
                                   
                                    <img src="{{asset('assets/img/icons/bkash-logo.svg')}}" >
                                    <span><span style="color:rgb(209, 32, 83)">Bkash Pay: </span><span class="font-weight-bold">{{$identities ? $identities->bkash_num : ''}}</span></span>
                        </div>
                    </div>
            </div>
        </div>
       
    
       
        
    </div>
 
   
    <!-- Checkout Area End Here -->
@endsection

@push('js_top')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush
