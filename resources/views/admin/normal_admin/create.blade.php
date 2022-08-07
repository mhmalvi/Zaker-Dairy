@extends('admin.layouts.app')

@section('title', 'Create new Admin')

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
                    <h3>Create new Admin</h3>
                    
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="homeSliderForm" action="{{url('admin/normal_admin/store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                   
                                    <div class="form-group">
                                        <label for="title">Name</label>
                                       <input type="text" name="name" id="title" class="form-control" placeholder="enter admin name">
                                       @error('name')
                                       <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="email">email</label>
                                       <input type="text" name="email" id="email" class="form-control" placeholder="enter admin email">
                                           @error('email')
                                           <p class="text-danger">{{$message}}</p>
                                           @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                       <input type="text" name="password" id="" class="form-control" placeholder="enter password">
                                           @error('password')
                                           <p class="text-danger">{{$message}}</p>
                                           @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password </label>

                                       <input type="text" name="password_confirmation" id="" class="form-control" placeholder="re enter password">
                                           @error('password_confirmation')
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
