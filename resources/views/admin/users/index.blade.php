@extends('admin.layouts.app')

@section('title', 'Users Management')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-start">
                    <h3>User List</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <users-list-component />
                </div>
            </div>
        </div>
    </div>
@endsection
