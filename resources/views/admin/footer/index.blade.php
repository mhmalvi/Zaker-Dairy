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
    <div class="row d-flex justify-content-between mb-4">
         <h3>Footer Info</h3>
         <a href="{{ route('admin.footer.info.create') }}" class="btn btn-success">Create</a>
    </div>
 
    <div class="footer-table">
       <table class="table">
       <thead>
           <tr>
                <td>Logo</td>
                <td>Address</td>
                <td>Action</td>
           </tr>
       </thead>
       <tbody>
       @isset($footer)
            @foreach($footer as $item)
                  <tr>
                      <td><img src="{{ asset('assets/admin/img/footer-logo/'.$item->logo) }}" style="width:100px; height:100px;"></td>
                      <td>{{ $item->address }}</td>
                      <td>
                      
                            <a href="{{ route('admin.footer.info.edit', $item->id ) }}" class="btn btn-info">Edit</a>

                            <a href="{{ route('admin.footer.info.delete', $item->id) }}" class="btn btn-danger">Delete</a>

                      
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

