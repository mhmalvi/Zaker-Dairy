@extends('admin.layouts.app')

@section('title', 'Footer Info')

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
    <form action="{{route('admin.footer.info.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row pb-3">
            <div class="col-md-4">
                <h4>Footer Info</h4>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <div id="logo"></div>
                    @error('logo')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" rows="8" class="form-control col-6"></textarea>
                    @error('address')
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
    $(document).ready(function() {
        $("#logo").spartanMultiImagePicker({
            fieldName: 'logo'
            , maxCount: 1
        , });


    })

</script>
@endpush

