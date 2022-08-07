@extends('admin.layouts.app')

@section('title', 'Background')

@push('css')
<link href="{{asset('assets/admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/admin/css/plugins/summernote/summernote-bs4.css')}}" />
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
    <div class="row d-flex justify-content-between mb-4">
        <h3>Background</h3>
        <a href="{{ route('admin.backgrounds.create') }}" class="btn btn-success">Create</a>

    </div>

    <div class="footer-table">
        <table class="table">
            <thead>
                <tr>
                   
                    <td>Background Image</td>
                    <td>Background Title</td>
                    <td>Background alt</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @isset($backgrounds)

                    @foreach($backgrounds as $item)

                    <tr>
                       
                        <td><img src="{{ asset('assets/admin/img/background-image/'.$item->background) }}" style="width:100px; height:100px;"></td>

                        <td>{{ $item->background_title }}</td>
                        <td>{{ $item->background_alt }}</td>
                        <td>

                            <a href="{{ route('admin.backgrounds.edit', $item->id ) }}" class="btn btn-info">Edit</a>


                            <a href="{{ route('admin.backgrounds.delete', $item->id) }}" class="btn btn-danger">Delete</a>



                        </td>
                    </tr>

                    @endforeach
                @endisset

            </tbody>
        </table>
    </div>
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

