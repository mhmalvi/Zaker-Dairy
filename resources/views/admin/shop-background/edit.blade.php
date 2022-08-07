@extends('admin.layouts.app')

@section('title', 'Edit Background')

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
                        
        <form action="{{route('admin.backgrounds.update')}}" method="post" enctype="multipart/form-data">
            @csrf
           
            <div class="row pb-3">
                <div class="col-md-4">
                    <h4>Background Image</h4>
                </div>
                <div class="col-md-8">
                <input type="hidden" value="{{ $background->id }}" name="id">

                    <div class="form-group">
                        <label for="background">Background Image</label>
                        <div id="background"></div>
                        @error('background')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                          @if($background->background)
                            <div class="col-md-6 shop-background">
                                <li class="d-flex justify-content-between">
                                    <span class="file-name">
                                        {{ $background->background }}

                                    </span>
                                    <span class="remove-btn" data-name="{{ $background->background }}" style="cursor:pointer;">

                                        <i class="bi bi-x-lg"></i>
                                    </span>
                                </li>
                            </div>
                          @endif

                    </div>
                    <div class="form-group">
                        <label for="background_title">Background Title</label>
                        <input type="text" name="background_title" class="form-control" value="{{ $background->background_title }}">

                           @error('background_title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="background_alt">Background alt</label>
                        <input type="text" name="background_alt" class="form-control" value="{{ $background->background_alt }}">

                           @error('background_alt')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
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

            $("#background").spartanMultiImagePicker({
                fieldName:'background',
                maxCount: 1,
            });

             $('.remove-btn').click(function(e){
             e.preventDefault();
             $(this).parent().remove();
             })


           
        })
    </script>
@endpush
