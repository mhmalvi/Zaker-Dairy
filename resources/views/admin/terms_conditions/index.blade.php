@extends('admin.layouts.app')

@section('title', 'Terms & Conditions')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/summernote/summernote-bs4.css')}}"/>
@endpush

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.contents.save') }}" method="POST" enctype="multipart/form-data">
            @csrf

             @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                   {{Session::get('success')}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                        @endif

            <input type="hidden" name="key" value="terms_conditions">
            <input type="hidden" name="response_type" value="html">

            <div class="form-group">
                <h3>Terms and Conditions</h3>

                <textarea name="value" id="content" class="form-control" rows="15">{{ $content ? $content->value : "" }}</textarea>
            </div>

            <div class="form-group d-flex justify-content-end">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script src="{{asset('assets/admin/js/plugins/summernote/summernote-bs4.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#content').summernote({
                height: 400,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ],
                placeholder: 'Terms & Conditions content ...',
            })
        })
    </script>

@endpush
