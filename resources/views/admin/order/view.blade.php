@extends('admin.layouts.app')

@section('title', 'Order Details')

@section('content')
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>From:</h5>
                                    <address>
                                        <strong>{{ $order->actionuser ?  $order->actionuser->name : 'Guest' }}</strong><br>
                                        {{ $order->actionuser ? $order->actionuser->userinfo->address : 'Guest' }}<br>
                                        <abbr title="Phone">P:</abbr> {{ $order->actionuser ? $order->actionuser->userinfo->phone : '' }}
                                    </address>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h4>Invoice No.</h4>
                                    <h4 class="text-navy">INV-{{ $order->uuid }}</h4>
                                    <p>
                                        <span><strong>Invoice Date:</strong> {{ $order->created_at }}</span><br/>
                                    </p>
                                </div>
                            </div>

                            <div class="table-responsive m-t">
                                <table class="table invoice-table">
                                    <thead>
                                    <tr>
                                        <th>Item List</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart->items as $item)
                                            <tr>
                                                <td>
                                                    <div>
                                                        <strong>{{ $item['item']->name }}</strong>
                                                    </div>
                                                </td>
                                                <td>{{ $item['qty'] }}</td>
                                                <td>${{ $item['item']->price }}</td>
                                                <td>${{ $item['price'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>TOTAL :</strong></td>
                                    <td>${{ $cart->totalPrice }}</td>
                                </tr>
                                </tbody>
                            </table>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" onclick="printInvoice()">Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection


@push('js')
    <script>
        function printInvoice()
        {
            window.print();
        }
    </script>
@endpush
