@extends('admin.layouts.app')

@section('title', 'Categories')

@push('css')
    <link href="{{asset('assets/admin/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <create-category-component />
            </div>

            <div class="col-md-8">
                <div>
                    <category-list-component />
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{asset('assets/spartan/dist/js/spartan-multi-image-picker-min.js')}}"></script>

    <script>
        $("#thumbnail").spartanMultiImagePicker({
            fieldName:   'thumbnail',
            maxCount: 1,
            maxCount: 5,
            rowHeight: '90px',
            groupClassName: 'col-md-3 col-sm-3 col-xs-6',
        });
    </script>
@endpush
