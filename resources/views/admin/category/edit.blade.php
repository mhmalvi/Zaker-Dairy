@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <edit-category-component data="{{ json_encode($productCategory) }}" />
        </div>
    </div>
</div>
@endsection
