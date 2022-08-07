@extends('admin.layouts.app')

@section('title', 'Update Service slider')

@section('content')
    <div class="container">
        <div class="row text-center">
                     @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger">
                            {{Session::get('error')}}
                        </div>
                    @endif
                    
        </div>
       
             <div class="ibox ">
            <div class="ibox-content" id="ibox-content">
                
                <div class="row mb-3">
                    <h3>Update Servicer</h3>
                    
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="homeSliderForm" action="{{url('admin/service/update')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden"  value= "{{$service->id}}" name="id">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                       <input type="text" name="title" id="title" class="form-control" placeholder="enter slider title" value="{{$service->title}}">
                                       @error('title')
                                       <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="sub_title">Sub Title</label>
                                       <input type="text" name="subtitle" id="sub_title" class="form-control" placeholder="enter slider sub title" value="{{$service->subtitle}}">
                                        @error('subtitle')
                                       <p class="text-danger">{{$message}}</p>
                                       @enderror
                                    </div>
                               
                                    <div class="form-group">
                                        <label for="photo">Service Icon</label>
                                      <div id="serviceImage"></div>
                                           @error('service_icon')
                                           <p class="text-danger">{{$message}}</p>
                                           @enderror
                                            
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success" id="submitBtn">Update</button>
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
            $("#serviceImage").spartanMultiImagePicker({
                fieldName:'serviceIcon',
                maxCount: 1,
                 rowHeight: '90px',
                groupClassName: 'col-md-2 col-sm-2 col-xs-6',
            });

         
        })
    


    </script>
@endpush
@endsection

