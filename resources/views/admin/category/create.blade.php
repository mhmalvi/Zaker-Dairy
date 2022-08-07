@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Create New Category</h5>
            </div>
            <div class="ibox-content">
                <create-category-component />
            </div>
        </div>
    </div>
@endsection
