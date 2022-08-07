<footer class="footer-area">
    <div class="footer-widget-area">
        <div class="container container-default custom-area">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-custom">
                    <div class="single-footer-widget m-0">
                        <div class="footer-logo d-flex justify-content-center">
                            @if($identities)
                            <a href="https://zakerdairyfarm.com/" >
                                <img src="{{asset('storage/app/public/website_identity/logo/'.$identities->logo)}}" alt="Logo Image" style="max-width: 120px;">

                            </a>
                            @else
                             <a href="https://zakerdairyfarm.com/" >
                                <img src="{{asset('assets/admin/img/footer-logo/footer_default_logo.png')}}" alt="Logo Image" style="max-width: 120px;">

                            </a>
                            @endif
                        </div>
                        <div class='d-flex justify-content-center'>
                            <p class="firmName">Zaker Dairy Farm</p>
                        </div>

                        <div class="social-links">
                            <ul class="d-flex justify-content-center">
                                <li>
                                    <a class="border rounded-circle" href="{{ $identities ? $identities->facebook : 'javascript:void(0)' }}" title="Facebook" target="_blank">
                                        <i class="fa fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="border rounded-circle" href="{{ $identities ? $identities->twitter : 'javascript:void(0)' }}" title="Twitter" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="border rounded-circle" href="{{ $identities ? $identities->linkedin : 'javascript:void(0)' }}" title="Linkedin" target="_blank">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="border rounded-circle" href="{{ $identities ? $identities->youtube : 'javascript:void(0)' }}" title="Youtube" target="_blank">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="border rounded-circle" href="{{ $identities ? $identities->instagram : 'javascript:void(0)' }}" title="instagram" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-custom">
                    <div class="single-footer-widget">
                        <h2 class="widget-title">Quicklink</h2>
                        <ul class="widget-list">
                            <li><a href="{{route('index')}}">Home</a></li>
                         
                            <li><a href="{{route('about.us')}}">About</a></li>
                            <li><a href="{{route('shop')}}">Shop</a></li>
                            <li><a href="{{route('contact.us')}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-custom">
                    <div class="single-footer-widget">
                        <h2 class="widget-title">See Information</h2>
                        <div class="widget-body">
                            @if($identities)
                                <address>{{ $identities->address }}</address>
                            @else
                             <address>Not Input yet..!!</address>
                             @endif
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright-area">
        <div class="container custom-area">
            <div class="row">
                <div class="col-12 text-center col-custom">
                    <div class="copyright-content">
                        <p>Copyright © 2020 <a href="https://quadque.tech/" title="https://quadque.tech/">Zaker Dairy</a> | Developed by <a href="https://quadque.tech/" title="https://quadque.tech/">Quadque Technologies ltd</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
