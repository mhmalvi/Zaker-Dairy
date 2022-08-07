@extends('admin.layouts.app')

@section('title', 'Footer Info Edit')

@push('css')
<link href="{{asset('assets/admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/admin/css/plugins/summernote/summernote-bs4.css')}}" />
@endpush

@section('content')
<div class="container">
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success')}}
    </div>
    @endif
    <form action="{{route('admin.footer.info.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row pb-3">
            <div class="col-md-4">
                <h4>Footer Info</h4>
            </div>
            <div class="col-md-8">
             <input type="hidden" value="{{ $footer->id }}" name="id">
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <div id="logo"></div>
                    {{-- <p>{{ $footer->logo }}</p> --}}
                    @error('logo')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    @if($footer->logo)
                    <div class="col-md-6 footer-logo">
                        <li class="d-flex justify-content-between">
                            <span class="file-name">
                                {{ $footer->logo }}
                            </span>
                            <span class="remove-btn" data-name="{{ $footer->logo }}" style="cursor:pointer;">
                                <i class="bi bi-x-lg"></i>
                            </span>
                        </li>
                    </div> 
                    @endif
                  
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" rows="8" class="form-control col-6">{{ $footer->address }}</textarea>
                    @error('address')
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
  

{{--  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<script src="{{asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('assets/admin/js/plugins/summernote/summernote-bs4.js')}}"></script>
<script src="{{asset('assets/spartan/dist/js/spartan-multi-image-picker-min.js')}}"></script>

<script>

    $(document).ready(function() {
        $("#logo").spartanMultiImagePicker({
            fieldName: 'logo'
            , maxCount: 1
        , });
    $('.remove-btn').click(function(e){
        e.preventDefault();
        $(this).parent().remove();
    })


    })



</script>
@endpush

