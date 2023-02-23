<header id="header">
    <div class="container">
        <div class="content">
            <div class="d-flex align-items-center justify-content-between">
                <div class="logo"><a href="{{url('/')}}"><img src="{{asset('web/assets/images/Logo.png')}}" alt=""></a></div>
                @if(Auth::check())
                    <div class="menu_site">
                        <div class="slide-mobile"></div>
                        <ul id="primary-menu">
                            <li><a href="" id="close_menu">إغلاق</a></li>
                            <li><a href="{{ url('/') }}">الرئيسية</a></li>
                            <li><a href="{{ LaravelLocalization::localizeUrl('/articleCategories') }}">@lang('web.articles')</a></li>
                            <li><a href="{{ LaravelLocalization::localizeUrl('/videos') }}">@lang('web.videos')</a></li>
                            <li><a href="{{ LaravelLocalization::localizeUrl('/restaurant') }}">@lang('web.restaurant')</a></li>
                            <li><a href="{{ LaravelLocalization::localizeUrl('/store') }}">@lang('web.store')</a></li>
                            <li><a href="{{ LaravelLocalization::localizeUrl('/subscriptions') }}">@lang('web.subscriptions')</a></li>
                          <li><a href="{{ LaravelLocalization::localizeUrl('/getFavorite') }}">@lang('web.favorite')</a></li>
                            {{--  <li class="has-child-menu">--}}
                             {{--    <a href="javascript:void(0)">المفضلة <i class="fa-solid fa-angle-down"></i></a>--}}
                             {{--    <ul class="sub-menu">--}}
                               {{--      <li><a href="{{ LaravelLocalization::localizeUrl('/store/getFavorite') }}"> @lang('web.getStoreFavorite')</a></li>--}}
                               {{--      <li><a href="{{ LaravelLocalization::localizeUrl('/restaurant/getFavorite') }}"> @lang('web.getRestaurantFavorite')</a></li>--}}
                              {{--   </ul>--}}
                           {{--  </li>--}}
                            {{--                        <li><a href="">الاستشارات</a></li>--}}
                            @if(auth()->check())
                                <li class="logout"><a href="{{LaravelLocalization::localizeUrl('/logout')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i> @lang('web.logout')</a></li>
                            @endif
                        </ul>
                    </div>
                @endif
                <div class="links">
                    <ul class="d-flex list-unstyled align-items-center mb-0">
                        @if(auth()->check())
                            <li>
                                <a href="{{LaravelLocalization::localizeUrl('/profile')}}" class="user">
                                    @if(!empty(auth()->user()->image))
                                        <img src="{{auth()->user()->image}}" alt="">
                                    @else
                                        <img src="{{asset('web/assets/images/user.jpg')}}" alt="">
                                    @endif
                                    <span class="d-none d-md-inline-block"> {{auth()->user()->name}}</span>
                                </a>
                            </li>
                            <li class="logout"><a href="{{LaravelLocalization::localizeUrl('/logout')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i> @lang('web.logout')</a></li>
                        @else
                            <li>
                                <a href="{{LaravelLocalization::localizeUrl('/login')}}">
                                    <i class="fa-solid fa-arrow-right-to-bracket d-none d-md-inline-block"></i>
                                    <span>    @lang('web.login')</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{LaravelLocalization::localizeUrl('/register')}}">
                                    <i class="fa-solid fa-arrow-right-to-bracket d-none d-md-inline-block"></i>
                                    <span>   @lang('web.register')</span>
                                </a>
                            </li>
                        @endif

                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a class="lang" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                        @if(auth()->check())
                            @if(\App\Models\RestaurantCart::where('user_id',auth()->user()->id)->count() > 0)
                                <li><a class="cart-link" href="{{LaravelLocalization::localizeUrl('/restaurant/cart')}}" id="toggle"><i class="fa-solid fa-cart-shopping"></i><em>{{getCartCount()}}</em></a></li>
                            @else
                                <li><a class="cart-link" href="{{LaravelLocalization::localizeUrl('/store/cart')}}" id="toggle"><i class="fa-solid fa-cart-shopping"></i><em>{{getCartCount()}}</em></a></li>
                            @endif
                        @endif

                        {{--                        <li><a href="" id="toggle"><i class="fa-solid fa-bars"></i></a></li>--}}
                    </ul>
                    @if(auth()->check())
                        <div class="mobile-btn"><div class="mobile-icon"></div></div>
                        {{-- <div id="btn_menu"><i class="fa-solid fa-bars"></i></div> --}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
