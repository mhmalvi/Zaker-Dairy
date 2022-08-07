 @include('layouts.styles')
<div class="row justify-content-center" id="{{ $unique_id }}">
    @each('components.home.more_product', $products, 'product', 'components.empty')
</div>

@include('layouts.scripts')
