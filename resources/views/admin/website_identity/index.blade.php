@extends('admin.layouts.app')

@section('title', 'Website Identity')

@section('content')
    <div class="container-fluid">
     
       
        <form action="{{ route('admin.website_identity.update') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                       @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                   {{Session::get('success')}}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                            </div>
                        @endif
                    @method('patch')
                    @csrf

                    <div class="form-group">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control">
                        @if($errors->has('logo'))
                            <small class="text-danger">
                                {{ $errors->first('logo') }}
                            </small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" name="phone"
                            value="{{ $identity ? $identity->phone : "" }}"
                            >
                        @if($errors->has('phone'))
                            <small class="text-danger">
                                {{ $errors->first('phone') }}
                            </small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="bkash_num" class="form-label">Bkash Number</label>
                        <input type="text" class="form-control" name="bkash_num"
                            value="{{ $identity ? $identity->bkash_num : "" }}"
                            >
                        @if($errors->has('bkash_num'))
                            <small class="text-danger">
                                {{ $errors->first('bkash_num') }}
                            </small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address"
                            value="{{ $identity ? $identity->address : "" }}"
                        >
                        @if($errors->has('address'))
                            <small class="text-danger">
                                {{ $errors->first('address') }}
                            </small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Favicon</label>
                        <input type="file" class="form-control" name="favicon">
                        @if($errors->has('favicon'))
                            <small class="text-danger">
                                {{ $errors->first('favicon') }}
                            </small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label">Free Home Delivery?</label>
                        <div class="form-check">
                            <label>
                                <input type="checkbox" class="form-check-input" name="free_home_delivery"
                                    {{ $identity && $identity->free_home_delivery ? 'checked' : '' }}>
                                Yes, I want to offer free home delivery
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary btn-block">
                            Update
                        </button>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3>Social links</h3>

                            <div class="form-group">
                                <label for="address" class="form-label">Facebook</label>
                                <input type="text" class="form-control" name="facebook"
                                    value="{{ $identity ? $identity->facebook : "" }}"
                                >
                                @if($errors->has('facebook'))
                                    <small class="text-danger">
                                        {{ $errors->first('facebook') }}
                                    </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address" class="form-label">Twitter</label>
                                <input type="text" class="form-control" name="twitter"
                                    value="{{ $identity ? $identity->twitter : "" }}"
                                >
                                @if($errors->has('twitter'))
                                    <small class="text-danger">
                                        {{ $errors->first('twitter') }}
                                    </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address" class="form-label">Instagram</label>
                                <input type="text" class="form-control" name="instagram"
                                    value="{{ $identity ? $identity->instagram : "" }}"
                                >
                                @if($errors->has('instagram'))
                                    <small class="text-danger">
                                        {{ $errors->first('instagram') }}
                                    </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address" class="form-label">Linkedin</label>
                                <input type="text" class="form-control" name="linkedin"
                                    value="{{ $identity ? $identity->linkedin : "" }}"
                                >
                                @if($errors->has('linkedin'))
                                    <small class="text-danger">
                                        {{ $errors->first('linkedin') }}
                                    </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="address" class="form-label">Youtube</label>
                                <input type="text" class="form-control" name="youtube"
                                    value="{{ $identity ? $identity->youtube : "" }}"
                                >
                                @if($errors->has('youtube'))
                                    <small class="text-danger">
                                        {{ $errors->first('youtube') }}
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
