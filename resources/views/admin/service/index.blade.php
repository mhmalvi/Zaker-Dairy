@extends('admin.layouts.app')

@section('title', 'Service')

@section('content')
    <div class="container-fluid">
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
                    <h3>Create New Service</h3>
                    
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <form id="serviceForm" action="{{url('admin/service/store')}}" method="POST" enctype="multipart/form-data">
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
                                        <label for="photo">Service Icon</label>
                                        <div id="serviceImage"></div>
                                           @error('service_icon')
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
        <div class="row d-flex justify-content-between mb-2">
            <div>  <h3>Services</h3></div>
             
        </div>
    
        <div class="row">
            
                    <div class="col-md-12">
                            
                            <table class="table table-bordered">
                                <thead class="bg-light">
                                     <tr>
                                         <th>Service N0.</th>
                                         <th>Title</th>
                                         <th>Sub Title</th>
                                         <th>Service </th>
                                         <th>Action</th>
                                     </tr>
                                </thead>
                                <tbody>
                                   
                                        @if($services)
                                            @foreach($services as $service)
                                             <tr>
                                                 <td>{{$loop->index + 1}}</td>
                                                 <td>{{$service->title}}</td>
                                                 <td>{{$service->subtitle}}</td>
                                                 <td><img src="{{asset('assets/img/service/'.$service->service_icon)}}" width="100" height="100"></td>
                                                 <td><a href="{{url('admin/service/edit/'.$service->id)}}" class = "btn btn-info mr-1">Edit</a><a href="{{url('admin/service/delete/'.$service->id)}}" class = "btn btn-danger ml-1">Delete</a></td>
                                             </tr>
                                            @endforeach
                                        @else
                                        <h4>No Home Service Found</h4>
                                        @endif
                                   
                                </tbody>
                            </table>
                       
                   
               </div>
          
        </div>
    </div>
    @push('js')
    <!-- iCheck -->
    <script src="{{asset('assets/spartan/dist/js/spartan-multi-image-picker-min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $("#serviceImage").spartanMultiImagePicker({
                fieldName:'service_icon',
                maxCount: 1,
                groupClassName: 'col-md-2 col-sm-2 col-xs-6',
                 rowHeight: '90px',
            });

         
        })
    </script>
@endpush
@endsection

