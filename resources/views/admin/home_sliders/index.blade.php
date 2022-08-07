@extends('admin.layouts.app')

@section('title', 'Home Sliders')

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
        <div class="row d-flex justify-content-between mb-2">
            <div>  <h3>Home Sliders</h3></div>
              <div class="ml-2">
                        <a href="{{ route('admin.home_sliders.create') }}" class="btn btn-primary btn-sm">Create</a>
              </div>
        </div>
    
        <div class="row">
            
                    <div class="col-md-12">
                            
                            <table class="table table-bordered">
                                <thead class="bg-light">
                                     <tr>
                                         <th>Slide N0.</th>
                                         <th>Title</th>
                                         <th>Sub Title</th>
                                         <th>Button Text</th>
                                         <th>Button Link</th>
                                         <th>Image</th>
                                         <th>Action</th>
                                     </tr>
                                </thead>
                                <tbody>
                                   
                                        @if($homeSliders)
                                            @foreach($homeSliders as $homeSlider)
                                             <tr>
                                                 <td>{{$loop->index + 1}}</td>
                                                 <td>{{$homeSlider->title}}</td>
                                                 <td>{{$homeSlider->subtitle}}</td>
                                                 <td>{{$homeSlider->button_text}}</td>
                                                 <td>{{$homeSlider->button_link}}</td>
                                                 <td><img src="{{asset('assets/img/homeSlider/'.$homeSlider->image)}}" width="100" height="100"></td>
                                                 <td><a href="{{url('admin/home_sliders/'.$homeSlider->id.'/edit/')}}" class = "btn btn-info mr-1">Edit</a><a href="{{url('admin/home_sliders/'.$homeSlider->id.'/delete/')}}" class = "btn btn-danger ml-1">Delete</a></td>
                                             </tr>
                                            @endforeach
                                        @else
                                        <h4>No Home Sliders Found</h4>
                                        @endif
                                   
                                </tbody>
                            </table>
                       
                   
               </div>
          
        </div>
    </div>
@endsection

