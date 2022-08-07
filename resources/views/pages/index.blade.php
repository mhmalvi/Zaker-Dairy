@extends('layouts.app')

@section('content')
    {{-- all categories component --}}
    @include("components.home.all_categories")
    {{-- all categories component ends --}}

    {{-- Promotion banner area --}}
    @if($banner_1_url || $banner_2_url)
        <div class="product-area mt-text mb-text-p">
            <div class="container container-default custom-area">
                <div class="row d-flex justify-content-center">
                    @if($banner_1_url)
                        <div class="col-lg-8 d-flex justify-content-center text-left col-custom">
                            <img src="{{ $banner_1_url }}" alt="Promotional banner">
                        </div>
                    @endif
                    @if($banner_2_url)
                        <div class="col-lg-4 mt-2 mt-lg-0 d-flex justify-content-center text-left col-custom">
                            <img src="{{ $banner_2_url }}" alt="Promotional banner">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Product Area Start Here -->
    <div class="product-area mt-text mb-text-p">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-12 text-left col-custom">
                    <div class="section-content">
                        <h2 class="title-1 text-uppercase">
                            <a href="{{ $sweets_url }}">
                                Sweets
                            </a>
                        </h2>
                        <div class="desc-content">
                            <p>Products of sweets category</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sweets-category-products row">
                <div class="owl-carousel owl-theme">
                    @each('components.best', $sweets_products, 'product', 'components.empty')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <div>
                    <button class="btn btn-primary view-all-btn">
                        <a href="{{ $sweets_url }}" class="mt-2 h6">
                            View all
                        </a>
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->

    <!-- Product Area Start Here -->
    <div class="product-area mt-text mb-text-p">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-12 text-left col-custom">
                    <div class="section-content">
                        <h2 class="title-1 text-uppercase">
                            <a href="{{ $bakery_url }}">
                                Bakery
                            </a>
                        </h2>
                        <div class="desc-content">
                            <p>Products of bakery category</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bakery-category-products row">
                <div class="owl-carousel owl-theme">
                    @each('components.best', $bakery_products, 'product', 'components.empty')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary view-all-btn">
                        <a href="{{ $bakery_url }}" class="mt-2 h6">
                            View all
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->

    <!-- Product Area Start Here -->
    <div class="product-area mt-text mb-text-p">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-12 text-left col-custom">
                    <div class="section-content">
                        <h2 class="title-1 text-uppercase">
                            <a href="{{ $dairy_url }}">
                                Dairy
                            </a>
                        </h2>
                        <div class="desc-content">
                            <p>Products of dairy category</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dairy-category-products row">
                <div class="owl-carousel owl-theme">
                    @each('components.best', $dairy_products, 'product', 'components.empty')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary view-all-btn">
                        <a href="{{ $dairy_url }}" class="mt-2 h6">
                            View all
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->

    {{-- scroll paginated other products --}}
    <div class="product-area mt-text mb-text-p" id="dairy_and_others_wrapper">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-lg-5 m-auto text-center col-custom">
                    <div class="section-content">
                        <h2 class="title-1 text-uppercase">Our All Products</h2>
                        <div class="desc-content">
                            <p>Products of other categories</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="other_products" class="md-px-0 px-4">
            </div>
            <div class="row" id="other_products_loading_animation">
                <div class="d-flex justify-content-center">
                    Loading products
                    <div class="spinner-border text-primary ml-2 mt-1" role="status">
                    </div>
                </div>
            </div>
            <div class="row" id="no_more_products">
                <div class="d-flex justify-content-center">
                    <h3>No More Products</h3>
                </div>
            </div>
            <div class="row" id="other_products_bottom"></div>
        </div>
    </div>

    <!-- Modal Area Start Here -->
    <div class="modal fade obrien-modal" id="quickview" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close close-button" data-dismiss="modal" aria-label="Close">
                    <span class="close-icon" aria-hidden="true">x</span>
                </button>
                <div class="modal-body" id="quick-view-body"></div>
            </div>
        </div>
    </div>
    <!-- Modal Area End Here -->
@endsection
