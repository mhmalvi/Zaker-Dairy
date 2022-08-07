@extends('layouts.app')
@push('css')

 <link rel="stylesheet" src="{{asset('css/shop/shop_custom.css')}}">
 <style>
     .ajax_load{
             top: 50%;
    right: 0%;
    position: fixed;
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
                        <h3 class="title-3 text-light">Shop Sidebar</h3>
                        
                        @php 
                             $routeName = \Route::currentRouteName();
                        @endphp
                        
                        @if($routeName == 'shop')
                         <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li>Shop</li>
                        </ul>
                        @elseif($routeName == 'category')
                         <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li>Shop</li>
                            <li>{{ucfirst($category->category)}}</li>
                          
                        </ul>
                        
                        @endif
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->

    <!-- Shop Main Area Start Here -->
    <div class="shop-main-area pb-4">
        <div class="container container-default custom-area">
            <div class="row flex-row-reverse">
                <div class="col-lg-10 col-12 col-custom widget-mt widget-mt-mobile order-2 order-lg-1">
                   <!-- Shop Wrapper Start -->
                    <div class="shop_wrapper product_section">
                        @include('pages.shop_products')
                     </div>
 <!-- Shop Wrapper End -->
                </div>
                <div class="ajax_load text-center" style="display:none; position:fixed">
                    <p><img src="{{asset('assets/img/icons/loader.gif')}}" width="100" height="100"></p>
                </div>
                <div class="col-lg-2 col-12 col-custom order-1 order-sm-2">
                    <!-- Sidebar Widget Start -->
                    <aside class="sidebar_widget widget-mt ">
                        <div class="widget_inner">
                            <div class="widget-list d-flex flex-row flex-sm-column justify-content-between">
                                  <div class="d-block d-sm-none"><button class="btn show-category" style="color: #000;font-size: 10px;padding: 8px 14px;border-radius: 25px;background-color: #cfc4c4;
">SHOW CATEGORIES</button></div>
                                <h3 class="widget-title">Categories</h3>
                              
                                <div class="sidebar-body d-none d-sm-block">
                                    <ul class="sidebar-list">
                                        @forelse ($categories as $item)
                                            <li><a href="{{route('category', $item->slug)}}">{{$item->category}}({{count($item->products)}})</a></li>
                                        @empty
                                            <li>No Categories Added Yet!</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <div class="category_list">
                         <div class="sidebar-body category-list">
                                    <ul class="sidebar-list">
                                        @forelse ($categories as $item)
                                            <li><a href="{{route('category', $item->slug)}}">{{$item->category}}({{count($item->products)}})</a></li>
                                        @empty
                                            <li>No Categories Added Yet!</li>
                                        @endforelse
                                    </ul>
                                </div>
                    </div>
                    <!-- Sidebar Widget End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Main Area End Here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
           
          var boolean = true;
          var current_page = 1;
          
            
        function loadMoreData(page){
                
                $('.ajax_load').show()
                $.ajax({
                    url:'?page='+page,
                    type:'get',
                   
                })
                .done(function(data){
                      $('.ajax_load').hide()
                    if(data.html == ''){
                        
                        boolean = false;
                        current_page = -1;
                    
                         
                    }else{
                        $('.shop_wrapper').append(data.html);
                      
                    }
                       
                })
        }
        
        $(window).scroll(function(){
            
            var scrollTop = $(window).scrollTop();
            var documentHeight = $(document).height();
            var windowHeight = $(window).height() ;
            var diffHeight = documentHeight - windowHeight; 
            
            if(boolean == true && current_page > 0 ){
                 if( scrollTop + windowHeight >= windowHeight ){
                       
                        current_page++;
                        loadMoreData(current_page);
               
                    
            }     
            }
            
            
           
        })   
        
     
    </script>
@endsection
