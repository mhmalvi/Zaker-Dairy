@extends('layouts.app')

@section('content')
    <!-- Breadcrumb Area Start Here -->
     @if($background)
            <div class="breadcrumbs-area position-relative" style="background-image: url({{asset('assets/admin/img/background-image/'.$background->background)}});">
      @else
      <div class="breadcrumbs-area position-relative" style="background-image: url({{asset('assets/admin/img/background-image/demo-background.jpg')}});">
      @endif
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="breadcrumb-content position-relative section-content">
                        <h3 class="title-3 text-light">My Account</h3>
                        <ul>
                            <li><a href="{{route('index')}}">Home</a></li>
                            <li>My Account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End Here -->
    <!-- my account wrapper start -->
    <div class="my-account-wrapper mt-no-text mb-no-text" style="margin-bottom: 10rem;">
        <div class="container container-default-2 custom-area">
            <div class="row">
          <div>
               @if($errors->any())
                    @foreach ($errors->all() as $error)
                            <div class="text-center text-danger">{{ $error }}</div>
                    @endforeach
               @endif

               @if(Session::has('success'))
                    <div class="text-center alert alert-success">{{ Session::get('success') }}</div>

               @endif
               @if(Session::has('error'))
                    <div class="text-center alert alert-danger">{{ Session::get('error') }}</div>

               @endif
               @if(Session::has('fail'))
                    <div class="text-center alert alert-danger">{{ Session::get('fail') }}</div>

               @endif

           </div>
        </div>
            <div class="row">
                <div class="col-lg-12 col-custom">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-custom">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="{{route('dashboard')}}" class="active" data-toggle="tab">
                                        <i class="fa fa-dashboard"></i>&nbsp;Dashboard
                                    </a>
                                    <a href="#orders" data-toggle="tab">
                                        <i class="fa fa-cart-arrow-down"></i>&nbsp;Orders
                                    </a>
                                    <a href="#address-edit" data-toggle="tab">
                                        <i class="fa fa-map-marker"></i>&nbsp;address
                                    </a>
                                    <a href="#account-info" data-toggle="tab">
                                        <i class="fa fa-user"></i>&nbsp;Account Details
                                    </a>
                                    <form action="{{ route('logout') }}" method="post" id="logoutForm">@csrf</form>
                                    <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                        <i class="fa fa-sign-out"></i>&nbsp;Logout
                                    </a>
                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8 col-custom">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Dashboard</h3>
                                            <div class="welcome">
                                                <p>Hello, <strong>{{ $user->name }}</strong> (If Not <strong>{{ $user->name }} !</strong><a href="javascript:void(0)" class="logout" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"> Logout</a>)</p>
                                            </div>
                                            <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Orders</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($orders as $item)
                                                            <tr>
                                                                <td>{{$item->uuid}}</td>
                                                                <td>{{$item->created_at}}</td>
                                                                <td>
                                                                    {{$item->status}}
                                                                </td>
                                                                <td>{{$item->total}}</td>
                                                                <td><a href="{{ route('view.order', $item->id) }}" class="btn obrien-button-2 primary-color rounded-0">View</a></td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5">No data found!</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="download" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Downloads</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Date</th>
                                                            <th>Expire</th>
                                                            <th>Download</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Haven - Free Real Estate PSD Template</td>
                                                            <td>Aug 22, 2018</td>
                                                            <td>Yes</td>
                                                            <td><a href="#" class="btn obrien-button-2 primary-color rounded-0"><i class="fa fa-cloud-download mr-2"></i>Download File</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>HasTech - Profolio Business Template</td>
                                                            <td>Sep 12, 2018</td>
                                                            <td>Never</td>
                                                            <td><a href="#" class="btn obrien-button-2 primary-color rounded-0"><i class="fa fa-cloud-download mr-2"></i>Download File</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Payment Method</h3>
                                            <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Billing Address</h3>
                                            <address>
                                                <p><strong>{{ ucfirst($user_info->first_name).' '.ucfirst($user_info->last_name) }}</strong></p>


                                                <p>{{ $user_info->billing_address }}</p>
                                                <p>Mobile: {{ $user_info->phone }}</p>
                                            </address>
                                            <a href="#edit" data-toggle="modal" class="btn obrien-button-2 primary-color rounded-0"><i class="fa fa-edit mr-2"></i>Edit Address</a>
                                        </div>
                                    </div>

                                 <!--   edit modal -->

                                  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Edit Billing Address</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                                <form action="{{ route('update.billing.address') }}" method="POST" id="editForm">
                                                    @csrf
                                                    <div class="modal-body">
                                                                <input type="hidden" name="user_id" value="{{ $user_info->user_id }}">
                                                                    <div class="form-group">
                                                                        <label>Billing Address</label>
                                                                        <textarea name="billing_address"  class="form-control">{{ $user_info->billing_address }}</textarea>
                                                                    </div>
                                                        </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary obrien-button-2" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary obrien-button-2">Update</button>
                                                </div>
                                               </form>

                                          </div>
                                      </div>
                                  </div>


                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Account Details</h3>
                                            <div class="account-details-form">
                                                <form action="{{ route('update.user') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user_info->user_id }}">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-custom">
                                                            <div class="single-input-item mb-3">
                                                                <label for="first-name" class="required mb-1">First Name</label>
                                                                <input type="text" name="first_name" id="first-name" placeholder="First Name"  value="{{ $user_info->first_name }}"/>
                                                               

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-custom">
                                                            <div class="single-input-item mb-3">
                                                                <label for="last-name" class="required mb-1">Last Name</label>
                                                                <input type="text" name="last_name" id="last-name" placeholder="Last Name" value="{{ $user_info->last_name }}" />
                                                                  

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="display-name" class="required mb-1">Display Name</label>
                                                        <input type="text" name="display_name" id="display-name" placeholder="Display Name" value="{{ $user->name }}" />
                                                      

                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="email" class="required mb-1">Email Addres</label>
                                                        <input type="email" name="email" id="email" placeholder="Email Address" value="{{ $user->email }}" />
                                                      
                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="mobile" class="required mb-1">Mobile No.</label>
                                                        <input type="text" name="mobile" id="mobile" placeholder="enter mobile number" value="{{ $user_info->phone }}" />
                                                      
                                                    </div>
                                                    <fieldset>
                                                        <legend>Password change</legend>
                                                        <div class="single-input-item mb-3">
                                                            <label for="current-pwd" class="required mb-1">Current Password</label>
                                                            <input type="password" name="current_password" id="current-pwd" value='' placeholder="Current Password" />
                                                            

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-custom">
                                                                <div class="single-input-item mb-3">
                                                                    <label for="new-pwd" class="required mb-1">New Password</label>
                                                                    <input type="password" name="password" id="new-pwd" placeholder="New Password" />
                                                                  
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-custom">
                                                                <div class="single-input-item mb-3">
                                                                    <label for="confirm-pwd" class="required mb-1">Confirm Password</label>
                                                                    <input type="password" name="password_confirmation" id="confirm-pwd" placeholder="Confirm Password" />

                                                                   

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item single-item-button">
                                                        <button class="btn obrien-button primary-btn" style="font-size:15px">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> <!-- Single Tab Content End -->
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->
@endsection
