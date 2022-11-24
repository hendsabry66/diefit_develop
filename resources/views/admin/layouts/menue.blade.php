<div class="main-menu menu-fixed menu-dark menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.areas')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'areas') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/areas')}}" data-i18n="nav.dash.ecommerce">@lang('admin.areas')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'areas') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/cities')}}" data-i18n="nav.dash.project">@lang('admin.cities')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'districts') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/districts')}}" data-i18n="nav.dash.project">@lang('admin.districts')</a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.pages')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'pages') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/pages')}}" data-i18n="nav.dash.ecommerce">@lang('admin.pages')</a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.users')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'users') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/users')}}" data-i18n="nav.dash.ecommerce">@lang('admin.users')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'roles') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/roles')}}" data-i18n="nav.dash.project">@lang('admin.roles')</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.articles')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'articles') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/articles')}}" data-i18n="nav.dash.ecommerce">@lang('admin.articles')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'article_categories') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/article_categories')}}" data-i18n="nav.dash.project">@lang('admin.article_categories')</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.videos')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'videos') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/videos')}}" data-i18n="nav.dash.ecommerce">@lang('admin.videos')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'video_categories') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/video_categories')}}" data-i18n="nav.dash.project">@lang('admin.video_categories')</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.foods')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'foods') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/foods')}}" data-i18n="nav.dash.ecommerce">@lang('admin.foods')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'foodCategories') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/foodCategories')}}" data-i18n="nav.dash.project">@lang('admin.foodCategories')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'extras') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/extras')}}" data-i18n="nav.dash.project">@lang('admin.extras')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'foodTypes') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/foodTypes')}}" data-i18n="nav.dash.ecommerce">@lang('admin.foodTypes')</a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.settings')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'sliders') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/sliders')}}" data-i18n="nav.dash.ecommerce">@lang('admin.sliders')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'branches') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/branches')}}" data-i18n="nav.dash.project">@lang('admin.branches')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'teamMembers') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/teamMembers')}}" data-i18n="nav.dash.project">@lang('admin.teamMembers')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'clientReviews') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/clientReviews')}}" data-i18n="nav.dash.project">@lang('admin.clientReviews')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'settings') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/settings')}}" data-i18n="nav.dash.project">@lang('admin.settings')</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.subscriptions')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'subscriptions') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/subscriptions')}}" data-i18n="nav.dash.ecommerce">@lang('admin.subscriptions')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'types') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/types')}}" data-i18n="nav.dash.project">@lang('admin.types')</a>
                    </li>
{{--                    <li class="{{ (request()->segment(2) == 'teamMembers') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/teamMembers')}}" data-i18n="nav.dash.project">@lang('admin.teamMembers')</a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ (request()->segment(2) == 'clientReviews') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/clientReviews')}}" data-i18n="nav.dash.project">@lang('admin.clientReviews')</a>--}}
{{--                    </li>--}}
                </ul>
            </li>

            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.weekFoods')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'weekFoods') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/weekFoods')}}" data-i18n="nav.dash.ecommerce">@lang('admin.weekFoods')</a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.products')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'products') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/products')}}" data-i18n="nav.dash.ecommerce">@lang('admin.products')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'productCategories') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/productCategories')}}" data-i18n="nav.dash.project">@lang('admin.productCategories')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'ProductSpecificationCategory') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/ProductSpecificationCategory')}}" data-i18n="nav.dash.project">@lang('admin.ProductSpecificationCategory')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'ProductSpecification') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/ProductSpecification')}}" data-i18n="nav.dash.project">@lang('admin.ProductSpecification')</a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.bankAccounts')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'bankAccounts') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/bankAccounts')}}" data-i18n="nav.dash.ecommerce">@lang('admin.bankAccounts')</a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.status')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'status') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/status')}}" data-i18n="nav.dash.ecommerce">@lang('admin.status')</a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.orders')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'storeOrders') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/storeOrders')}}" data-i18n="nav.dash.ecommerce">@lang('admin.storeOrders')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'restaurantOrders') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/restaurantOrders')}}" data-i18n="nav.dash.ecommerce">@lang('admin.restaurantOrders')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'subscriptionOrders') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/subscriptionOrders')}}" data-i18n="nav.dash.ecommerce">@lang('admin.subscriptionOrders')</a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href=""><i class="icon-home"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('admin.checkBankTransfer')</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->segment(2) == 'storeOrderPendding') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/storeOrderPendding/pendding')}}" data-i18n="nav.dash.ecommerce">@lang('admin.storeOrders')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'restaurantOrderPendding') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/restaurantOrderPendding/pendding')}}" data-i18n="nav.dash.ecommerce">@lang('admin.restaurantOrders')</a>
                    </li>
                    <li class="{{ (request()->segment(2) == 'subscriptionOrderPendding') ? 'active' : '' }}"><a class="menu-item" href="{{url('admin/subscriptionOrderPendding/pendding')}}" data-i18n="nav.dash.ecommerce">@lang('admin.subscriptionOrders')</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
