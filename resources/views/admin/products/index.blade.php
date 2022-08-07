@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-start">
                    <h3>Product List</h3>
                    <div>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm ml-2">Create</a>
                    </div>
                </div>
            </div>
                        @if(Session::has('message'))
                            <div class="alert alert-{{ Session::get('alert_type') }} alert-dismissible fade show" role="alert">
                                   {{Session::get('message')}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                        @endif
            <form action="{{ route('admin.products') }}" method="GET" id="filter_form">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="col-form-label" for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="" selected>All</option>
                                <option value="published"
                                    @if (request()->get('status') == 'published')
                                        selected
                                    @endif
                                >Published</option>
                                <option value="unpublished"
                                    @if (request()->get('status') == 'unpublished')
                                        selected
                                    @endif
                                >Unpublished</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4 offset-sm-4">
                        <div class="form-group">
                            <label class="col-form-label" for="product_name">Product Name</label>
                            <input type="text" id="product_name" name="product_name" value="{{ $old_data->get('product_name') }}" placeholder="Product Name" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button class="btn btn-default mr-2 btn-sm" id="clear_filter" type="button">Clear</button>
                        <button class="btn btn-primary btn-sm" id="submit_button" type="submit">Filter</button>
                    </div>
                </div>
            </form>

            <table class="table table-stripped toggle-arrow-tiny">
                <thead>
                <tr>
                    <th data-hide="phone" data-sort-ignore="true"></th>
                    <th data-toggle="true">Name</th>
                    <th data-hide="phone">Category</th>
                    <th data-hide="phone">Price</th>
                    <th data-hide="phone">Discount</th>
                    <th data-hide="phone">Stock Status</th>
                    <th data-hide="phone">Status</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/app/public/products/'.$product->thumbnail)}}" alt="{{$product->name}}" style="max-width: 50px;">

                            </td>
                            <td>
                                {{$product->name}}

                                <div class="mt-4">
                                    <a href="{{route('admin.product.view', $product->uuid)}}" class="pr-3">View</a>
                                    <a href="{{route('admin.product.edit', $product->uuid)}}" class="pr-3">Edit</a>
                                    <a href="javascript:void(0)" class="pr-3 product-trash-link" data-uuid="{{ $product->uuid }}">Trash</a>
                                </div>
                            </td>
                            <td>{{$product->productCategory()}}</td>
                            <td>{{$product->price}} tk</td>
                            <td>{{$product->discount}} {{$product->discount_type}}</td>
                            <td>{{$product->out_of_stock == 0 ? "In Stock" : "Out Of Stock"}}</td>
                            <td>
                                @if ($product->publish)
                                    <span class="label label-success">Published</span>
                                @else
                                    <span class="label label-primary">Draft</span>
                                @endif
                            </td>
                        </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="row d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#clear_filter").click(function () {
                console.log("working")
                $('#status').val("");
                $('#product_name').val("");
                $("#submit_button").trigger("click");
            });

            $(".product-trash-link").click(function () {
                if(confirm("Are you sure you want to delete this product?"))
                {
                    var uuid = $(this).attr('data-uuid');
                    var delete_link = `/admin/products/${uuid}/trash`;
                    window.location.href = delete_link;
                }
            })
        })
    </script>
@endpush
