@extends('admin.layouts.app')

@section('title', 'Add New Product')

@push('css')
    <link href="{{asset('assets/admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/summernote/summernote-bs4.css')}}"/>
@endpush

@section('content')
    <div class="container">
       
        @if(Session::has('message'))
                            <div class="alert alert-{{ Session::get('alert_type') }} alert-dismissible fade show" role="alert">
                                   {{Session::get('message')}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                        @endif
        
        <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row pb-3">
                <div class="col-md-4">
                    <h4>Product's Basic Informations</h4>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="name">Product Name <small class="text-danger">*</small> </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Product title" value="{{old('name')}}"/>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category">Product Category<small class="text-danger">*</small></label>
                        <select name="category" id="category" class="form-control">
                            <option value selected disabled>Select a category</option>
                            @forelse ($categories as $item)
                                <option value="{{$item->id}}">{{$item->category}}</option>
                            @empty
                                <option>No Category added!</option>
                            @endforelse
                        </select>
                        @error('category')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Price<small class="text-danger">*</small></label>
                        <input type="number" name="price" id="price" class="form-control" placeholder="Product price..." value="{{old('price') ? old('price') : 0}}"/>
                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row form-group">
                        <div class="col-md-8">
                            <label for="discount">Discount</label>
                            <input type="number" name="discount" id="discount" class="form-control"
                                placeholder="Product discounted price..." value="{{old('discount') ? old('discount') : 0}}"/>
                            @error('discount')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="dType">Discount Type</label>
                            <select name="dType" id="dType" class="form-control">
                                <option value="flat" selected>Flat</option>
                                <option value="percent" {{old('dType') == 'percent' ? 'selected' : ''}}>Percent</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="unit_qty">Minimum Sale Unit</label>
                            <input type="number" name="unit_qty" id="unit_qty" class="form-control"
                                placeholder="Unit quantity. e.g- 1 kg" value="{{old('unit_qty') ? old('unit_qty') : 1}}"/>
                        </div>
                        <div class="col-md-4">
                            <label for="out_of_stock">Stock Status</label>
                            <select name="out_of_stock" id="out_of_stock" class="form-control">
                                <option value="0" selected>In Stock</option>
                                <option value="1" >Out Of Stock</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="unit">Unit Type</label>
                            <select name="unit" id="unit" class="form-control">
                                <option value="kg" selected>kg</option>
                                <option value="gm" {{old('unit') == 'gm' ? 'selected' : ''}}>gram</option>
                                <option value="ltr" {{old('unit') == 'ltr' ? 'selected' : ''}}>liter</option>
                                <option value="ml" {{old('unit') == 'ml' ? 'selected' : ''}}>ml</option>
                                <option value="pcs" {{old('unit') == 'pcs' ? 'selected' : ''}}>piece</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pb-3">
                <div class="col-md-4">
                    <h4>Product's Images</h4>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="thumbnail">Product Thumbnail Image</label>
                        <div id="thumbnail"></div>
                        @error('thumbnail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="thumb_title">Product Thumbnail Title</label>
                        <input type="text" name="thumb_title" class="form-control" placeholder="Thumbnail title ..">
                    </div>
                    <div class="form-group">
                        <label for="thumb_title">Product Thumbnail alt</label>
                        <input type="text" name="thumb_alt" class="form-control" placeholder="Thumbnail alt ..">
                    </div>
                    <div class="form-group">
                        <label for="gallary">Gallary Images</label>
                        <div id="images" class="row"></div>
                    </div>
                </div>
            </div>

            <div class="row pb-3">
                <div class="col-md-4">
                    <h4>Product's SEO Informations</h4>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" placeholder="one, two, three, four, five">
                    </div>
                    <div class="form-group">
                        <label for="meta_tags">Meta Tags</label>
                        <input type="text" name="meta_tags" id="meta_tags" class="form-control" placeholder="one, two, three, four, five">
                    </div>
                    <div class="form-group">
                        <label for="meta_des">Meta Description</label>
                        <textarea name="meta_des" id="meta_des" rows="5" style="resize: none;" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <div class="row pb-3">
                <div class="col-md-4">
                    <h4>Product's Specification Details</h4>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="details">Descriptions</label>
                        <textarea name="details" id="details" class="form-control" rows="15">{{old('details')}}</textarea>
                        @error('details')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <h4>Actions</h4>
                </div>
                <div class="col-md-8">
                    <div class="i-checks">
                        <label>
                            <input type="checkbox" name="featured"  checked><i></i> Featured Product
                        </label>
                    </div>

                    <div class="i-checks">
                        <label>
                            <input type="checkbox" name="publish"  checked><i></i> Publish
                        </label>
                    </div>

                    <div class="py-4">
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </div>
                </div>
            </div>
        </form>
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
