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
                        <h3 class="title-3 text-light">Contact us</h3>
                        <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li>Contact us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- Contact Us Area Start Here -->
    <div class="contact-us-area">
        <div class="container container-default-2 custom-area">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-custom">
                    <div class="contact-info-item">
                        <div class="con-info-icon">
                            <i class="ion-ios-location-outline"></i>
                        </div>
                        <div class="con-info-txt">
                            <h4>Our Location</h4>
                            <p>28/1, Road: 3/B, Mohammadia Housing, Mohammadpur,Dhaka 1207</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-custom">
                    <div class="contact-info-item">
                        <div class="con-info-icon">
                            <i class="ion-iphone"></i>
                        </div>
                        <div class="con-info-txt">
                            <h4>Contact us Anytime</h4>
                            <p>Mobile: 01676-083713</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(Session::has('success'))
                    <div class="alert alert-success mt-3"><button type='button' class='close mr-5' data-dismiss='alert'>&times;</button>{{Session::get('success')}}</div>
                @endif
                
                <div class="col-md-12 col-custom">
                    <form method="post" action="{{ route('contact.mail') }}"  accept-charset="UTF-8">
                        @csrf
                        <div class="comment-box mt-5">
                            <h5 class="text-uppercase">Get in Touch</h5>
                           
                            <div class="row mt-3">
                                <div class="col-md-6 col-custom">
                                    <div class="input-item mb-4">
                                        <input class="border rounded-0 w-100 input-area name" type="text" name="name" id="con_name" placeholder="Name">
                                          @error('name')
                                    <p  class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>
                                  
                                </div>
                                <div class="col-md-6 col-custom">
                                    <div class="input-item mb-4">
                                        <input class="border rounded-0 w-100 input-area email" type="email" name="email" id="con_email" placeholder="Email">
                                          @error('email')
                                     <p class="text-danger">{{ $message }}</p>
                                     @enderror
                                    </div>
                                   

                                </div>
                                <div class="col-md-6 col-custom">
                                    <div class="input-item mb-4">
                                        <input class="border rounded-0 w-100 input-area email" type="text" name="mobile" id="con_email" placeholder="Mobile Number">
                                         @error('mobile')
                                             <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    

                                </div>
                                <div class="col-md-6 col-custom">
                                    <div class="input-item mb-4">
                                        <input class="border rounded-0 w-100 input-area email" type="text" name="subject" id="con_content" placeholder="Subject">
                                          @error('subject')
                                             <p class="text-danger">{{ $message }}</p>
                                          @enderror
                                    </div>
                                   

                                </div>
                                <div class="col-12 col-custom">
                                    <div class="input-item mb-4">
                                        <textarea cols="30" rows="5" class="border rounded-0 w-100 custom-textarea input-area" name="message" id="con_message" placeholder="Message"></textarea>
                                          @error('message')
                                            <p class="text-danger">{{ $message }}</p>
                                          @enderror
                                    </div>
                                   

                                </div>
                                <div class="col-12 col-custom mt-40">
                                    <button type="submit"   class="btn obrien-button primary-btn rounded-0 mb-0">Send A Message</button>
                                </div>
                              
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Us Area End Here -->
@endsection