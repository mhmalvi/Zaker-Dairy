@extends('admin.layouts.app')

@section('title', 'Add Background')

@push('css')
    <link href="{{asset('assets/admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/summernote/summernote-bs4.css')}}"/>
@endpush

@section('content')
    <div class="container">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                   {{Session::get('success')}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                        @endif
                         @if(Session::has('warning'))
                            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                                   {{Session::get('warning')}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                        @endif
        <form action="{{route('admin.backgrounds.store')}}" method="post" enctype="multipart/form-data">
            @csrf
           
            <div class="row pb-3">
                <div class="col-md-4">
                    <h4>Background Image</h4>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="background">Background Page</label>
                        <select class="form-control" name="background_type" id="background">
                               <option selected disable>Select page for background</option>
                               <option value="shop_page">Shop Page</option>
                               <option value="contact_page">Contact Page</option>
                               <option value="about_us_page">About Us Page</option>
                               <option value="terms_condition_page">Terms and Condition</option>
                               <option value="cart_page">Cart Page</option>
                               <option value="checkout_page">Checkout Page</option>
                               <option value="login_page">login Page</option>
                               <option value="register_page">Register Page</option>
                               <option value="dashboard_page">User Dashboard Page</option>
                               
                        </select>
                        @error('background_type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="background">Background Image</label>
                        <div id="background-img"></div>
                        @error('background')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="background_title">Background Title</label>
                        <input type="text" name="background_title" class="form-control" placeholder="Background title ..">
                           @error('background_title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="background_alt">Background alt</label>
                        <input type="text" name="background_alt" class="form-control" placeholder="Background alt ..">
                           @error('background_alt')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                   
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <!-- iCheck -->
    <script src="{{asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/summernote/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/spartan/dist/js/spartan-multi-image-picker-min.js')}}"></script>
 

    <script>
        $(document).ready(function(){
            $("#background-img").spartanMultiImagePicker({
                fieldName:'background',
                maxCount: 1,
            });

           
        })
    </script>
@endpush
