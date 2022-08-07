<div class="d-flex justify-content-center">
    <a href="{{ route('category', ['slug' => $category->slug]) }}">
        <div class="card category-item">
            <div class="card-body row">
                <div class="col-12 d-flex justify-content-center">
                    <img src="{{ $category ? $category->getThumbnail() : ''}}" alt="{{ $category ? $category->category : '' }}"
                        width="60" height="60"
                        class="total-circle">
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <p>
                        <b>
                            {{ $category ? $category->category : '' }}
                        </b>
                    </p>
                </div>
            </div>
        </div>
    </a>
</div>
