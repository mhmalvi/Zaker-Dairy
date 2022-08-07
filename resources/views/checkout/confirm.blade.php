@extends('layouts.app')

@push('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

        #order {
            background-color: #ffe8d2;
            font-family: 'Montserrat', sans-serif
        }

        .card {
            border: none
        }

        .logo {
            background-color: #eeeeeea8
        }

        .totals tr td {
            font-size: 13px
        }

        .footer {
            background-color: #eeeeeea8
        }

        .footer span {
            font-size: 12px
        }

        .product-qty span {
            font-size: 12px;
            color: #dedbdb
        }
    </style>
@endpush

@section('content')
    <div class="container mt-5 mb-5" id="order">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-center logo p-2 px-5">
                        <img src="{{asset('assets/logo.png')}}" width="100">

                        <h4>
                            Thanks for shopping with us!
                        </h4>
                    </div>
                    <div class="invoice p-5">
                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="py-2">
                                                <span class="d-block text-muted">
                                                    Order Date
                                                </span> 
                                                <span>
                                                    {{$summery['order_date']}}
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="py-2">
                                                <span class="d-block text-muted">
                                                    Order No
                                                </span>
                                                <span>
                                                    {{$summery['order_id']}}
                                                </span> 
                                            </div>
                                        </td>
                                        <td>
                                            <div class="py-2">
                                                <span class="d-block text-muted">
                                                    Payment
                                                </span>
                                                <span>
                                                   {{ $summery['payment_method'] == 'cash' ? 'Cash On Delivery' : 'Bkash Payment'}}

                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="py-2">
                                                <span class="d-block text-muted">
                                                    Shiping Address
                                                </span>
                                                <span>
                                                    {{$summery['shipping']}}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product border-bottom table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                @isset($products)
                                    @foreach ($products as $item)
                                        <tr>
                                            <td width="20%"> <img src="{{asset('https://zakerdairyfarm.com//storage/app/public/products/'.$item['item']['thumbnail'])}}" width="90"> </td>
                                            <td width="60%"> <span class="font-weight-bold">{{$item['item']['name']}}</span>
                                                <div class="product-qty"> <span class="d-block">Quantity: {{$item['qty']}}</span></div>
                                            </td>
                                            <td width="20%">
                                                <div class="text-right"> <span class="font-weight-bold">{{($item['item']['price']) * ($item['qty'])}}&nbsp;tk</span> </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                                </tbody>
                            </table>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <div class="col-md-5">
                                <table class="table table-borderless">
                                    <tbody class="totals">
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Subtotal</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>{{$totalPrice}}&nbsp;tk</span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Shipping Fee</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>0.00 tk</span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Tax Fee</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span>0.00 tk</span> </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left"> <span class="text-muted">Discount</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span class="text-success">0.00 tk</span> </div>
                                            </td>
                                        </tr>
                                        <tr class="border-top border-bottom">
                                            <td>
                                                <div class="text-left"> <span class="font-weight-bold">Subtotal</span> </div>
                                            </td>
                                            <td>
                                                <div class="text-right"> <span class="font-weight-bold">{{$totalPrice}} &nbsp;tk</span> </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection