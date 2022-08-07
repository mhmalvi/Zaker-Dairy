@extends('admin.layouts.app')

@section('title', ' Admins')

@section('content')
<div class="container-fluid">
    <div class="row text-center">
        @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @elseif(Session::has('danger'))
        <div class="alert alert-danger">
            {{Session::get('error')}}
        </div>
        @endif

    </div>
    <div class="row d-flex justify-content-between mb-2">
        <div>
            <h3>Admins</h3>
        </div>
        <div class="ml-2">
            <a href="{{ route('admin.normal_admin.create') }}" class="btn btn-primary btn-sm">Create</a>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th>Slide N0.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @if($normal_admins)
                    @foreach($normal_admins as $normal_admin)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$normal_admin->name}}</td>
                                <td>{{$normal_admin->email}}</td>
                                <td><img src="{{asset('assets/img/users/'.$normal_admin->photo)}}" width="100" height="100"></td>

                                <td><a href="{{url('admin/normal_admin/'.$normal_admin->uuid.'/delete/')}}" class="btn btn-danger">Delete</a></td>


                            </tr>
                            @endforeach
                    @else
                    <h4>No Admin Found</h4>
                    @endif

                </tbody>
            </table>


        </div>

    </div>
</div>
@endsection

