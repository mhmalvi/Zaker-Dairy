@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Area Start Here -->
    <div class="breadcrumbs-area position-relative" style="background-image: url({{asset('assets/img/banner/3.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3 text-light">Error 404</h3>
                        <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li>Error 404</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->

    <!-- Error 404 Area Start Here -->
    <div class="error-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="error_form">
                        <h1>404</h1>
                        <h2>Opps! PAGE NOT BE FOUND</h2>
                        <p>Sorry but the page you are looking for does not exist, have been<br> removed, name changed or is temporarily unavailable.</p>

                        <a href="{{route('index')}}">Back to home page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Error 404 Area End Here -->
@endsection
