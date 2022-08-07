<div class="product-area mt-text mb-text-p">
    <div class="container container-default custom-area">
        <div class="row">
            <div class="col-lg-5 m-auto text-center col-custom">
                <div class="section-content">
                    <h2 class="title-1 text-uppercase">Categories</h2>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
         @isset($categories)
            @foreach ($categories as $category)
                <div class="col-md-2 col-4 mt-2">
                    @include("components.home.category", ["category" => $category])
                </div>
            @endforeach
         @endisset
        </div>
    </div>
</div>
