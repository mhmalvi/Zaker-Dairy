<!-- Main Header Area Start -->
<div class="main-header">
    <div class="container container-default custom-area">
        <div class="row">
            <div class="col-lg-12 col-custom">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-xl-2 col-sm-6 col-6 col-custom">
                        <div class="header-logo d-flex align-items-center">
                         
                           @if($identities)
                            <a href="https://zakerdairyfarm.com/">
                                <img class="img-full" src="{{asset('storage/app/public/website_identity/logo/'.$identities->logo)}}" alt="Header Logo">
                            </a>
                           @else
                           
                            <a href="https://zakerdairyfarm.com/" >
                                <img class="img-full" src="{{asset('assets/admin/img/footer-logo/footer_default_logo.png')}}" alt="Header Logo">

                            </a>
                            
                            @endif
                           
                        </div>
                    </div>
                    <div class="col-lg-8 col-xl-7 position-static d-none d-lg-block col-custom">
                        <nav class="main-nav d-flex justify-content-center">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('index')}}">
                                        <span class="menu-text"> Home</span>
                                    </a>
                                </li>
                                @php
                                    $categories = \App\Models\ProductCategory::with('children')->get();
                                @endphp
                                @isset($categories)
                                    <li>
                                        <a href="javascript:void(0)">
                                            <span class="menu-text">Categories</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="mega-menu dropdown-hover">
                                            <div class="menu-colum">
                                                <ul>
                                                    @foreach ($categories as $item)
                                                        @if(count($item->children) == 0 && $item->parent_id == null)
                                                            <li><a href="{{route('category', $item->slug)}}">{{$item->category}}</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>

                                            @foreach ($categories as $item)
                                                @if(count($item->children) > 0)
                                                    <div class="menu-colum">
                                                        <ul>
                                                            <li>
                                                                <a href="{{ route('category', $item->slug) }}">
                                                                    <span class="mega-menu-text ml-0">{{ $item->category }}</span>
                                                                </a>
                                                            </li>
                                                            @foreach ($item->children as $child)
                                                                <li><a href="{{ route('category', $child->slug) }}">{{ $child->category }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </li>
                                @endisset
                                <li>
                                    <a href="{{route('shop')}}">
                                        <span class="menu-text"> Shop</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('about.us')}}">
                                        <span class="menu-text"> About</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('contact.us')}}">
                                        <span class="menu-text">Contact</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('terms.conditions')}}">
                                        <span class="menu-text">Terms & Conditions</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-2 col-xl-3 col-sm-6 col-6 col-custom">
                        <div class="header-right-area main-nav">
                            <ul class="nav">
                                @auth
                                    <li class="sidemenu-wrap d-none d-lg-flex">
                                        <a href="javascript:void(0)">My Account <i class="fa fa-caret-down"></i> </a>
                                        <ul class="dropdown-sidemenu dropdown-hover-2 dropdown-language">
                                            <li>
                                                <a href="{{ auth()->user()->is_admin == 1 ? route('admin.dashboard') : route('dashboard')}}">
                                                    <i class="fa fa-th"></i>&nbsp;Dashboard
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('logout') }}" method="post" id="logoutForm">@csrf</form>
                                                <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                                    <i class="fa fa-sign-out"></i>&nbsp;Log out
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endauth

                                @guest
                                    <li class="login-register-wrap d-none d-xl-flex">
                                        <span><a href="{{route('login')}}">Login</a></span>
                                        <span><a href="{{route('register')}}">Register</a></span>
                                    </li>
                                @endguest
                                <li class="minicart-wrap">
                                    <a href="javascript:void(0)" class="minicart-btn toolbar-btn">
                                        <i class="ion-bag"></i>
                                        <span class="cart-item_count totalItem">
                                            {{(Session::has('cart')) ? Session::get('cart')->totalQty : 0}}
                                        </span>
                                    </a>
                                    <div class="cart-item-wrapper dropdown-sidemenu dropdown-hover-2">
                                        @include('components.minicart')
                                    </div>
                                </li>
                                <li class="mobile-menu-btn d-lg-none">
                                    <a class="off-canvas-btn" href="#">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Header Area End -->
