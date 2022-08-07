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
                        <h3 class="title-3 text-light">Register</h3>
                        <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li>Register</li>
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
                                <h2 class="title-4 mb-2">Create Account</h2>
                                <p class="desc-content">Please Register using account detail bellow.</p>
                            @endif
                        </div>
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="single-input-item mb-3">
                                <input type="text" placeholder="User Name" name="name" value="{{old('name')}}" required autofocus/>
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="email" placeholder="Email address" name="email" value="{{old('email')}}" required>
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="password" placeholder="Enter your Password" name="password" value="" required/>
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="password" placeholder="Confirm Password" name="password_confirmation" value="" required/>
                            </div>
                            <div class="single-input-item mb-3 d-flex justify-content-between">

                                <div><button class="btn obrien-button-2 primary-color">Register</button></div>
                             
                                 <div class="" style="margin-right: 5%">
                                        <a href="{{route('google.login')}}" class="social-login-item">
                                            <img src="{{ asset('assets/img/google-plus.png') }}" alt="Google">
                                        </a>
                                        <a href="{{route('facebook.login')}}" class="social-login-item ml-2">
                                            <img src="{{ asset('assets/img/facebook.png') }}" alt="Facebook">
                                        </a>
                                 </div>
                            </div>
                        </form>
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

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
