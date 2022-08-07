@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative" style="background-image: url({{asset('assets/img/banner/3.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3 text-light">Facebook Login</h3>
                        <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li>
                                <a href="{{ route('login') }}">Login</a>
                            </li>
                            <li>
                                Facebook login
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->

    <!-- Login Area Start Here -->
    <div class="login-register-area mt-no-text mb-no-text">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                    <div class="login-register-wrapper">
                        <div class="section-content text-center mb-5">
                            @if ($errors->any())
                                <div class="mb-4">
                                    <div class="text-danger">
                                        {{ __('Whoops! Something went wrong.') }}
                                    </div>

                                    <ul class="mt-3 text-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <h2 class="title-4 mb-2">We need some additional information</h2>
                                <p class="desc-content">Please provide your email</p>
                            @endif
                        </div>
                        <form action="{{ route('facebook.login.extra.submit') }}" method="POST">
                            @csrf
                            <div class="single-input-item mb-3">
                                <input type="email" name="email" placeholder="example@email.com" value="{{old('email')}}" autofocus />
                            </div>

                            <div class="single-input-item mb-3">
                                <button type="submit" class="btn obrien-button-2 primary-color">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Area End Here -->
@endsection
