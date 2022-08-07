<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="api-base-url" content="{{ URL::to('/') }}" />
        <title>Zaker Dairy</title>
        <meta name="robots" content="noindex, follow" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

        <!-- Favicon -->
        @php
        $identities = App\Models\WebsiteIdentity::first();
        @endphp
        @if($identities)
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/app/public/website_identity/fevicon/'.$identities->favicon)}}">
        @endif
     
        {{-- Css --}}
        @include('layouts.styles')
        @stack('css')

         <style>
             .widget-mt, .widget-mt-mobile {
                margin-top: 35px !important;
            }
        @media screen and (max-width: 576px) {
             .widget-mt-mobile {
                margin-top: 0px !important;
            }
            }

        .category-list{
            display: none;
            margin-bottom: 20px;
        }
        
       
        .footer-area .single-footer-widget .footer-logo {
             margin-bottom: 0px !important;
        }
        
        .firmName {
                font-size: 20px;
                color: #ef1b20;
                margin-bottom: 12px;
                font-weight: 600;
        }
        .item-img .card-img-top{
        height:145px !important;
        max-height: 145px !important;
    }
    
    .product-card {
        height:310px !important;
        max-height:310px !important;
    }
    
    .parentDropdown{
        display:none;
        height:0px;
    }
    
    .main-category{
        display:block;
        width:100%;
        
    }
    .main-category i{
        float:right;
        cursor:pointer;
        
    }
   
  
           
           
         </style>
    </head>
    <body>
        <div class="home-wrapper home-1" id="app" style="background-image: url('{{asset('assets/img/p17.png')}}')">
            <header class="main-header-area bg-light">
                {{-- @include('layouts.header') --}}
                @php
                   $footer = App\Models\FooterInfo::first();
                @endphp
                
                @include('layouts.nav')
                @include('layouts.nav-sticky')
                @include('layouts.nav-mobile')
            </header>

            @if (Route::currentRouteName() == 'index')
                @include('layouts.slider')
            @endif

            @yield('content')

            <!-- Support Area Start Here -->
            <div class="support-area my-0">
                <div class="container container-default custom-area">
                    <div class="row">
                        <div class="col-lg-12 col-custom">
                            <div class="support-wrapper d-flex">
                                <div class="support-content">
                                    <h1 class="title">Need Help ?</h1>
                                    <p class="desc-content">Call our support 24/7 at {{$identities ? $identities->bkash_num : ''}}</p>
                                </div>
                               
                             
                                <div class="support-button d-flex align-items-center">
                                    <a class="obrien-button primary-btn" href="{{route('contact.us')}}">Contact now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Support Area End Here -->

            @include('layouts.call_to_action')

            @include('layouts.footer')
        </div>

        {{-- @include('layouts.quickview') --}}

        <!-- Scroll to Top Start -->
        <a class="scroll-to-top" href="#">
            <i class="ion-chevron-up"></i>
        </a>
        <!-- Scroll to Top End -->

        {{-- Js --}}
        @include('layouts.scripts')
        @stack('script')
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        
        <script>
            $(document).ready(function(){
                
                        
                    $('.owl-carousel').owlCarousel({
                    autoplayHoverPause:true,
                    responsiveClass:true,
                    responsive:{
                        320:{
                            items:2,
                          
                        },
                        375:{
                            items:2,
                         
                        },
                        425:{
                            items:2,
                          
                        },
                        600:{
                            items:3,
                           
                        },
                        992:{
                            items:4,
                            
                        },
                        1224:{
                            items:5,
                            
                        },
                    }
                })
          
            })
            
            function parentDropdownCategory(domObj){
                
                let dropdown = $(domObj).data('dropdown');
                if(dropdown == 'close'){
                        $(domObj).find('i').css('transform','rotate(90deg)');
                        $(domObj).next().css('display','block');
                        $(domObj).next().css('height','auto');
                        $(domObj).data('dropdown', 'open');
                    
                       
                }else{
                        $(domObj).find('i').css('transform','rotate(0deg)');
                        $(domObj).next().css('display','none');
                        $(domObj).next().css('height','0');
                        $(domObj).data('dropdown', 'close');
                        
                }
                
             
            }
            
        
        </script>

    </body>
</html>
