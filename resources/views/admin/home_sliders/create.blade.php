@extends('admin.layouts.app')

@section('title', 'Create new home slider')

@section('content')
    <div class="container">
        <div class="row text-center">
                     @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @elseif(Session::has('danger'))
                        <div class="alert alert-danger">
                            {{Session::get('error')}}
                        </div>
                    @endif
                    
        </div>
       
             <div class="ibox ">
            <div class="ibox-content" id="ibox-content">
                
                <div class="row mb-3">
                    <h3>Create new home slider</h3>
                    
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="homeSliderForm" action="{{url('admin/home_sliders/store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                       <input type="text" name="title" id="title" class="form-control" placeholder="enter slider title">
                                       @error('title')
                                       <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="sub_title">Sub Title</label>
                                       <input type="text" name="subtitle" id="sub_title" class="form-control" placeholder="enter slider sub title">
                                        @error('subtitle')
                                       <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="button_text">Button Text</label>
                                       <input type="text" name="button_text" id="button_text" class="form-control" placeholder="enter slider button text">
                                           @error('button_text')
                                           <p class="text-danger">{{$message}}</p>
                                           @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="button_link">Button Link</label>
                                       <input type="text" name="button_link" id="" class="form-control" placeholder="enter slider button link">
                                           @error('button_link')
                                           <p class="text-danger">{{$message}}</p>
                                           @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Image</label>
                                        <div id="sliderImage"></div>
                                           @error('photo')
                                           <p class="text-danger">{{$message}}</p>
                                           @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" id="submitBtn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                       
                 
                </div>
            </div>
        </div>
        </div>
       
    </div>

@push('js')
    <!-- iCheck -->
    <script src="{{asset('assets/spartan/dist/js/spartan-multi-image-picker-min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $("#sliderImage").spartanMultiImagePicker({
                fieldName:'photo',
                maxCount: 1,
            });

         
        })
    </script>
@endpush
@endsection
