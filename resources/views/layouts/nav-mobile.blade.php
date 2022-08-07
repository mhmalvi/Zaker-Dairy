<!-- off-canvas menu start -->
<aside class="off-canvas-wrapper" id="mobileMenu">
    <div class="off-canvas-overlay"></div>
    <div class="off-canvas-inner-content">
        <div class="btn-close-off-canvas">
            <i class="fa fa-times"></i>
        </div>
        <div class="off-canvas-inner">
            <!-- mobile menu start -->
            <div class="mobile-navigation">
                <!-- mobile menu navigation start -->
                <nav>
                    <ul class="mobile-menu">
                        <li>
                            <a href="{{route('index')}}">
                                <span class="menu-text"> Home</span>
                            </a>
                        </li>
                        @php
                            $categories = \App\Models\ProductCategory::with('children')->get();
                        @endphp
                        <li class="menu-item-has-children mobile" >
                            <a href="javascript:void(0)" class="main-category" onclick="parentDropdownCategory(this)" data-dropdown ="close">Categories <i class="fa-solid fa-caret-right"></i></a>
                            @isset ($categories)
                                <ul class=" megamenu parentDropdown">
                                    @foreach ($categories as $item)
                                        @if(count($item->children) == 0 && $item->parent_id == null)
                                            <li class="mega-title">
                                                <a href="{{route('category', $item->slug)}}">{{$item->category}}</a>
                                            </li>
                                        @elseif($item->parent_id == null && count($item->children) > 0)
                                            <li class="mega-title has-children">
                                                <a href="javascript:void(0)" class="main-category" onclick="parentDropdownCategory(this)" data-dropdown ="close">{{$item->category}}<i class="fa-solid fa-caret-right"></i></a>
                                                <ul class="parentDropdown">
                                                    @foreach ($item->children as $child)
                                                        <li><a href="{{ route('category', $child->slug) }}">{{ $child->category }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
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

                        @guest
                            <li>
                                <a href="{{route('login')}}">
                                    <span class="menu-text">Login</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('register')}}">
                                    <span class="menu-text">Register</span>
                                </a>
                            </li>
                        @endguest
                    </ul>
                </nav>
                <!-- mobile menu navigation end -->
            </div>
            <!-- mobile menu end -->

            @auth
                <div class="header-top-settings offcanvas-curreny-lang-support">
                    <!-- mobile menu navigation start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><a href="javascript:void(0)" class="main-category" onclick="parentDropdownCategory(this)" data-dropdown ="close">My Account<i class="fa-solid fa-caret-right"></i></a>
                                <ul class="parentDropdown">
                                    <li>
                                        <a href="{{ auth()->user()->is_admin == 1 ? route('admin.dashboard') : route('dashboard')}}">
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="post" id="logoutForm">@csrf</form>
                                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                            Log out
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu navigation end -->
                </div>
            @endauth
        </div>
    </div>
    
</aside>
<!-- off-canvas menu end -->
