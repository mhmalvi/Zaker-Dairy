<div class="col-12 col-md-6 col-sm-6 col-lg-4  col-custom product-area">
    <div class="single-product position-relative shadow-sm">
        <div class="product-image">
            @php
                $slug = is_null($product->category_id) ? 'uncategorized' : $product->category->slug;
            @endphp
            <a class="d-block" href="{{route('item', [$slug, $product->slug])}}">
                <img src="{{asset('storage/products/'.$product->thumbnail)}}" alt="{{$product->name}}" class="product-image-1 w-100">
                <img src="{{asset('storage/products/'.$product->thumbnail)}}" alt="{{$product->name}}" class="product-image-2 position-absolute w-100">
            </a>
        </div>
        <div class="product-content">
            <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
            <div class="product-title pt-3">
                <h4 class="title-2"> <a href="{{route('item', [$slug, $product->slug])}}">{{$product->name}}</a></h4>
            </div>
            <div class="price-box">
                <span class="regular-price ">{{__($product->price)}}&nbsp;tk</span>
            </div>
        </div>
        <div class="add-action d-flex position-absolute">
            <a href="{{route('item', [$slug, $product->slug])}}" title="Add To cart">
                <i class="ion-bag"></i>&nbsp;
                Add to cart
            </a>
        </div>
        <div class="product-content-listview">
            <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
            <div class="product-title pt-3">
                <h4 class="title-2"> <a href="{{route('item', [$slug, $product->slug])}}">{{$product->name}}</a></h4>
            </div>
            <div class="price-box">
                <span class="regular-price ">{{__($product->price)}}&nbsp;tk</span>
            </div>
            <div class="add-action-listview d-flex">
                <a href="{{route('item', [$slug, $product->slug])}}" title="Add To cart">
                    <i class="ion-bag"></i>&nbsp;
                    Add to cart
                </a>
            </div>
        </div>
    </div>
</div>
