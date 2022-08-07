@extends('layouts.app')

@push('css')
<style>
    .desc-content ul li span{
        
         line-height:30px !important;
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
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3 text-light">About us</h3>
                        <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li>About us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
     <!-- Feature Area Start Here -->
    <div class="feature-area mb-no-text">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-xl-8 col-lg-5 col-md-12 col-custom">
                    <div class="feature-content-wrapper">
                        <h2 class="title">About Zaker Dairy</h2>
                        <div class="desc-content" style="text-align: justify;">
                            {!! $content ? $content->value : "" !!}
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-7 col-md-12 col-custom">
                    <div class="feature-image position-relative">
                         @if($image)
                            <img src="{{asset('assets/admin/img/content/'. $image->value)}}" alt="Zaker Dairy">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Area End Here -->
   
@endsection