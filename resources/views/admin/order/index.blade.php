@extends('admin.layouts.app')

@section('title', 'Orders')

@push('css')
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
    <div class="row d-flex justify-content-center">
            <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Order Filter</div>
                        </div>
                        <div class="card-body">
                           <form action="{{ route('admin.orders.filter') }}" Method="POST">
                              @csrf

                                    <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="status">Order Status</label>
                                                    <select class="form-control" id="status" name="status">
                                                        <option value="">Choose Status...</option>
                                                        <option value="approved">Approved</option>
                                                        <option value="pending">Pending</option>
                                                        <option value="delivered">Delivered</option>
                                                        <option value="canceled">Canceled</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="min_amount">Min Amount</label>
                                                    <input type="text" name="min_amount" class="form-control" id="min_amount">
                                                </div>

                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="max_amount">Max Amount</label>
                                                    <input type="text" name="max_amount" class="form-control" id="max_amount">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="date">Date</label>
                                                    <input type="date" name="date" class="form-control" id="date">
                                                </div>


                                            </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <button class="btn btn-info" type="submit">Filter</button>
                                                </div>
                                            </div>
                                    </div>
                           </form>
                          
                        </div>
                    </div>
            </div>
    </div>
    <div class="row d-block">
       @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                   {{Session::get('message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
       @endif
    </div>
        <div class="ibox ">
            <div class="ibox-content" id="ibox-content">
                <div class="sk-spinner sk-spinner-pulse"></div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="orders">
                        <thead>
                            <tr class="text-center">
                                <th width="10%">No</th>
                                <th width="20%">Customer</th>
                                <th width="20%">Ref</th>
                                <th width="10%">P.Method</th>
                                <th width="10%">Amount(BDT)</th>
                                <th width="10%">Ordered</th>
                                <th width="10%">Status</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $item)
                                <tr>
                                    <td>{{$item->uuid}}</td>
                                    <td>{{ $item->actionuser ? $item->actionuser->name : "N/A" }}</td>
                                    <td></td>
                                    <td>Bkash</td>
                                    <td>{{$item->total}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle">Actions</button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('admin.order.show', ['order' => $item->uuid]) }}">
                                                        <i class="fa fa-eye text-success"></i>&nbsp;View
                                                    </a>
                                                </li>
                                                
                                                @if($item->status == 'pending')
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('deliveredForm').submit()">
                                                        <i class="fa fa-eye text-success" ></i>&nbsp;Delivered
                                                    </a>
                                                    
                                                    <form id="deliveredForm" action="{{route('admin.order.status.update')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="uuid" value="{{$item->uuid}}">
                                                        <input type="hidden" name="status" value="d">
                                                        
                                                    </form>
                                                </li>
                                                @else
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('pendingForm').submit()">
                                                        <i class="fa fa-eye text-success" ></i>&nbsp;Pending
                                                    </a>
                                                    
                                                    <form id="pendingForm" action="{{route('admin.order.status.update')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="uuid" value="{{$item->uuid}}">
                                                        <input type="hidden" name="status" value="p">
                                                        
                                                    </form>
                                                </li>
                                                @endif
                                               
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets/admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            var categories = $('#orders').DataTable({
                responsive: true,
                processing: false,
                serverSide: false,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {
                        extend: 'pdf',
                        text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Pdf',
                        title: 'Orders'
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print',
                        customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');
                                $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                        }
                    },
                    {extend: 'csv',  title: 'orders'}
                ],

                order: [[2, 'asc']]
            });
        });

    </script>
@endpush
