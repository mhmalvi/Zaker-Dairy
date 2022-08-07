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
                        <h3 class="title-3 text-light">{{$product->name}}</h3>
                        <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li>{{$product->category->category}}</li>
                            <li>{{$product->name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Single Product Main Area Start -->
    <div class="single-product-main-area" style="margin-bottom: 100px;">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="row item-card-{{ $product->uuid }} mx-2 py-3">
                        <div class="col-lg-6 col-custom">
                            <div class="product-details-img horizontal-tab">
                                <div class="product-slider popup-gallery product-details_slider" data-slick-options='{
                            "slidesToShow": 1,
                            "arrows": false,
                            "fade": true,
                            "draggable": false,
                            "swipe": false,
                            "asNavFor": ".pd-slider-nav"
                            }'>
                                    @forelse ($product->images as $item)
                                        <div class="single-image border">
                                            <a href="{{asset('storage/app/public/products/'.$item->filename)}}">
                                                <img src="{{asset('storage/app/public/products/'.$item->filename)}}" alt="Product">
                                            </a>
                                        </div>
                                    @empty
                                        <div class="single-image border">
                                            <a href="https://via.placeholder.com/1000">
                                                <img src="https://via.placeholder.com/1000" alt="Product">
                                            </a>
                                        </div>
                                    @endforelse
                                </div>
                                <div class="pd-slider-nav product-slider" data-slick-options='{
                            "slidesToShow": 4,
                            "asNavFor": ".product-details_slider",
                            "focusOnSelect": true,
                            "arrows" : false,
                            "spaceBetween": 30,
                            "vertical" : false
                            }' data-slick-responsive='[
                                {"breakpoint":1501, "settings": {"slidesToShow": 4}},
                                {"breakpoint":1200, "settings": {"slidesToShow": 4}},
                                {"breakpoint":992, "settings": {"slidesToShow": 4}},
                                {"breakpoint":575, "settings": {"slidesToShow": 3}}
                            ]'>
                                    @forelse ($product->images as $item)
                                        <div class="single-thumb border">
                                            <img src="{{asset('storage/app/public/products/'.$item->filename)}}" alt="Product Thumnail">
                                        </div>
                                    @empty
                                        <div class="single-thumb border">
                                            <img src="https://via.placeholder.com/1000" alt="Product Thumnail">
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 col-custom">
                            <div>
                                <form  class="product py-2">
                                    <div class="product-summery position-relative">
                                        <div class="product-head mb-3">
                                            <h2 class="product-title">{{$product->name}}</h2>
                                        </div>
                                        <div class="price-box mb-2">
                                            <span class="regular-price">{{__($product->price)}}&nbsp;tk</span>
                                        </div>
                                        <div class="product-rating mb-3">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="sku mb-3">
                                            <div class="text-success d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                </svg>&nbsp;
                                                <p class="pl-2">In Stock</p>
                                            </div>
                                        </div>

                                        <div class="quantity-with_btn mb-4">
                                            <div class="quantity">
                                                     <div class="cart-plus-minus w-100">
                                                        <input class="cart-plus-minus-box w-100" value="1" type="text" id="item-{{$product->uuid}}">
                                                        <div class="dec qtybutton">-</div>
                                                        <div class="inc qtybutton">+</div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="add-to_cart">
                                            <button type="button" class="btn obrien-button primary-btn" onclick="addtocart('{{$product->uuid}}')">Add to cart</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-custom my-2">
                    <div class="row border py-2">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{asset('assets/logo.png')}}" alt="logo" style="max-width: 90px; margin-right: 15px;">
                            <p><strong>Vendor:&nbsp;</strong>Zaker Dairy</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="accordion py-3 px-0" id="accordionExample">
                            <div class="card">
                              <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                  <div class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card-2-front" viewBox="0 0 16 16">
                                            <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z"/>
                                            <path d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
                                        </svg>&nbsp;
                                        Payment Options
                                    </div>
                                </h2>
                              </div>

                              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            Bkash
                                        </li>
                                        <li class="list-group-item"><i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            Cash on delivery
                                        </li>
                                      </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>

            @if (!is_null($product->description))
                <div class="row mt-no-text">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#connect-1" role="tab" aria-selected="true">Description</a>
                            </li>
                        </ul>
                        <div class="tab-content mb-text" id="myTabContent">
                            <div class="tab-pane fade show active" id="connect-1" role="tabpanel" aria-labelledby="home-tab">
                                <div class="desc-content">
                                    {!!$product->description!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- Single Product Main Area End -->
@endsection
