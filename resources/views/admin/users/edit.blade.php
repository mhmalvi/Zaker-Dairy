@extends('admin.layouts.app')

@section('title', 'Edit - Users Management')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-start">
                    <h3>Edit a User</h3>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <edit-user-component data="{{ json_encode($user) }}" photo="{{($user->photo) }}" />


                </div>
            </div>
        </div>
    </div>
@endsection
