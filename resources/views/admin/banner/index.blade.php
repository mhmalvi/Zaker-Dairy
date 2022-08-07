@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="ibox ">
            <div class="ibox-content" id="ibox-content">
                <div class="row">
                    <div class="col-md-5">
                        <update-promotional-banner-component />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
