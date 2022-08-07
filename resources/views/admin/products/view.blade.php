@extends('admin.layouts.app')

@section('title', 'View Product')

@push('css')
    <link href="{{asset('assets/admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/summernote/summernote-bs4.css')}}"/>
@endpush

@section('content')

        <div class="container">
            <div class="row d-flex justify-content-between mb-5">
                <div>
                    <h4>Product Details</h4>
                </div>
                <div>
                    <a href="{{route('admin.products')}}" class ="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered text-center">
                       
                        <thead class="bg-light">
                            <tr>
                                <th> Name</th>
                                <th> Category</th>
                                <th> Price</th>
                                <th> Discount</th>
                                <th> Discount Type</th>
                                <th> Unit Quantity</th>
                                <th> Quantity</th>
                                <th> Out of Stock</th>
                                <th> Photo</th>
                                <th> Published </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ucfirst($product->name)}}</td>
                                <td>{{ucfirst($product->category ? $product->category->category : '' )}}</td>
                                <td>{{$product->price}} Tk</td>
                                <td>{{$product->discount}} %</td>
                                <td>{{ucfirst($product->discount_type)}} </td>
                                <td>{{$product->unit_qty}} </td>
                                <td>{{strtoupper($product->unit)}} </td>
                                <td>{{$product->out_of_stock == 0 ? 'Stock Out' : 'Stock In'}} </td>
                                <td><img src="{{asset('storage/app/public/products/'.$product->thumbnail)}}" width="80" height="80"></td>
                                <td>{{$product->publish == 1 ? 'Published' : 'Hidden'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
  
@endsection

@push('js')
    <!-- iCheck -->
    <script src="{{asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/summernote/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/spartan/dist/js/spartan-multi-image-picker-min.js')}}"></script>
    @include('admin.products.scripts')

    <script>
        $(document).ready(function(){
            $("#thumbnail").spartanMultiImagePicker({
                fieldName:'thumbnail',
                maxCount: 1,
            });

            $("#images").spartanMultiImagePicker({
                fieldName:'images[]',
                maxCount: 5,
                rowHeight: '90px',
                groupClassName: 'col-md-2 col-sm-2 col-xs-6',
            });
        })
    </script>
@endpush
