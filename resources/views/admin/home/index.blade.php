@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('css')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

<style>
    .card-counter{
    box-shadow: 2px 2px 10px #DADADA;
    margin: 5px;
    padding: 20px 10px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #DADADA;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  .card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }  

  .card-counter.success{
    background-color: #66bb6a;
    color: #FFF;
  }  

  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.2;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    font-style: italic;
    text-transform: capitalize;
    opacity: 1;
    display: block;
    font-size: 18px;
    color:#FFF;
  }
  
  .page-link {
   
    line-height: 1 !important;
   
}
</style>

@endpush

@section('content')
    <div class="container-fluid">
        <div class="ibox ">
            <div class="ibox-content" id="ibox-content">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{route('admin.orders')}}">
                              <div class="card-counter primary">
                                    <i class="fa fa-code-fork"></i>
                                    <span class="count-numbers">{{$order_numbers}}</span>
                                    <span class="count-name">Total Orders(Pending)</span>
                              </div>
                        </a>
                        </div>
                    
                        <div class="col-md-3">
                          <div class="card-counter danger">
                            <i class="fa fa-ticket"></i>
                            <span class="count-numbers">{{ $today_orders_numbers}}</span>
                            <span class="count-name">Todays Orders(Pending)</span>
                          </div>
                        </div>
                    
                        <div class="col-md-3">
                            <a href="{{route('admin.products')}}">
                                <div class="card-counter success">
                                <i class="fa fa-database"></i>
                                <span class="count-numbers">{{$total_products}}</span>
                                <span class="count-name">Total Products(Publish)</span>
                          </div>
                            </a>
                        </div>
                    
                        <div class="col-md-3">
                            <a href="{{route('admin.users.index')}}">
                                         <div class="card-counter info">
                                            <i class="fa fa-users"></i>
                                            <span class="count-numbers">{{$total_users}}</span>
                                            <span class="count-name">Total Users(Active)</span>
                                          </div>
                            </a>
                        </div>
                </div>
                <div class="row d-flex justify-content-center mt-5">
                    <div  class="col-md-12">
                        <table class="table table-bordered text-center">
                            <thead class="bg-light">
                                <tr>
                                    <th>Serial No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($users)
                                @foreach($users as $user)
                                     <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        @if($user->is_suspended == 'no')
                                        <td> <p class="badge badge-success">Active</p></td>
                                        @else
                                        <td> <p class="badge badge-danger">Suspended</p></td>
                                        @endif
                                        
                                     </tr>
                                @endforeach
                                @else
                                <h3>No data have found...!</h3>
                                @endif
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
  @push('js')
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  @endpush
@endsection
