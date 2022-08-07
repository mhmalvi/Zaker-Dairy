@extends('layouts.app')

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
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3 text-light">Login</h3>
                        <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li>Login</li>
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
                                 @if(Session::has('message'))
                            <p class="text-success">{{ Session::get('message') }}</p>
                        @endif
                            @if ($errors->any())
                                <div class="mb-4">
                                    <div class="text-danger">
                                        {{ __('Whoops! Something went wrong.') }}
                                    </div>

                                    <ul class="mt-3 text-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>
                                                <small>
                                                    {{ $error }}
                                                </small>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <h2 class="title-4 mb-2">Welcome back!</h2>
                                <p class="desc-content">Login to access your account.</p>
                            @endif
                        </div>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="single-input-item mb-3">
                                <input type="email" name="email" placeholder="example@email.com" value="{{old('email')}}" autofocus />
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="password" name="password" placeholder="Enter your Password" required />
                            </div>
                          
                            <div class="single-input-item mb-3">
                                <div class="mb-4 login-reg-form-meta d-flex align-items-center justify-content-between">
                                  {{--   <div class="remember-meta mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                            {{-- <label class="custom-control-label" for="rememberMe">Remember Me</label>
                                        </div>
                                    </div> --}}
                                       <div class="single-input-item">
                                        <a href="{{route('register')}}">Create Account</a>
                                     </div>
                                     <div>
                                            <a href="{{ route('password.request') }}" class="forget-pwd">Forget Password?</a>
                                     </div>
                                   
                                </div>
                            </div>
                            <div class="single-input-item mb-3 text-center">
                                <button type="submit" class="btn obrien-button-2 primary-color">Login</button>
                            </div>
                           
                        </form>
                        <div class="d-flex justify-content-center">
                            <a href="{{route('google.login')}}" class="social-login-item">
                                <img src="{{ asset('assets/img/google-plus.png') }}" alt="Google">
                            </a>
                            <a href="{{route('facebook.login')}}" class="social-login-item ml-2">
                                <img src="{{ asset('assets/img/facebook.png') }}" alt="Facebook">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Area End Here -->
@endsection

{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
