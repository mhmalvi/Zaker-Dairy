<!-- Call To Action Area Start Here -->
<div class="call-to-action-area" style="padding: 74px 0px; background-color: #fff;">
    <div class="container container-default custom-area">
        <div class="row">
            @isset($services)
                @foreach($services as $service)
                        <div class="col-6 col-custom ">
                            <div class="call-to-action-item mt-0 d-lg-flex d-md-block align-items-center">
                                <div class="call-to-action-icon">
                                    <img src="{{asset('assets/img/service/'.$service->service_icon)}}" alt="Icon">
                                </div>
                                <div class="call-to-action-info">
                                    <h3 class="action-title">{{ $service->title }}</h3>
                                    <p class="desc-content mb-5">{{ $service->subtitle }}</p>
                                </div>
                            </div>
                        </div>
                @endforeach
            @endisset
          

        </div>
    </div>
</div>
<!-- Call to Action Area End Here -->
