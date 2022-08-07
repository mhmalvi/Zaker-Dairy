<div class="slider-area">
    <div class="obrien-slider arrow-style" data-slick-options='{
        "slidesToShow": 1,
        "slidesToScroll": 1,
        "infinite": true,
        "arrows": true,
        "dots": true,
        "autoplay" : true,
        "fade" : true,
        "autoplaySpeed" : 7000,
        "pauseOnHover" : false,
        "pauseOnFocus" : false
        }' data-slick-responsive='[
        {"breakpoint":992, "settings": {
        "slidesToShow": 1,
        "arrows": false,
        "dots": true
        }}
        ]'>
        
        @isset($homeSliders)
           @foreach($homeSliders as $homeSlider)
              <div class="slide-item slide-1 bg-position slide-bg-1 animation-style-01" style="background-image: url({{asset('assets/img/homeSlider/'.$homeSlider->image)}})">
               <div class="slider-content">
                <h4 class="slider-small-title text-light">{{$homeSlider->subtitle}}</h4>
                <h2 class="slider-large-title text-light">{{$homeSlider->title}}</h2>
                <div class="slider-btn">
                    <a class="obrien-button btn-light" href="{{$homeSlider->button_link}}">{{$homeSlider->button_text}}</a>
                </div>
              </div>
           </div>
          @endforeach
        @endisset
    </div>
</div>