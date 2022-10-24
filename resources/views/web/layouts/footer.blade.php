<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="item-footer about">
                    <div class="logo">
                        <img src="assets/images/Logo.png" alt="">
                    </div>
                    <ul class="social d-flex list-unstyled">
                        <li><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-youtube"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-twitter"></i></a></li>
                        <li><a href=""><i class="fa-solid fa-paper-plane"></i></a></li>
                        <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="item-footer">
                    <h2>لا نقدم حيلًا سحرية لإنقاص الوزن
                        في ليلة واحدة</h2>
                    <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على
                        الشكل الخارجي للنص </p>
                    <ul class="links list-unstyled d-flex">
                        <li><a class="btn btn-outline-light" href="{{url('contact')}}"> @lang('web.contact')</a></li>
                        <li><a class="btn btn-success" href="{{url('store')}}"> @lang('web.join_us')</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="item-footer">
                    <h2>@lang('web.quick_links')</h2>
                    <ul class="list-unstyled">
                        <li><a href="{{ LaravelLocalization::localizeUrl('/store') }}">@lang('web.store')</a></li>
                        <li><a href="{{ LaravelLocalization::localizeUrl('/restaurant') }}">@lang('web.restaurant')</a></li>
{{--                        <li><a href="">الاستشارات</a></li>--}}
                        <li><a href="{{ LaravelLocalization::localizeUrl('/articleCategories') }}">@lang('web.articles')</a></li>
                        <li><a href="{{ LaravelLocalization::localizeUrl('/subscriptions') }}">@lang('web.subscriptions')</a></li>
{{--                        <li><a href="">نظام العمولة</a></li>--}}
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="item-footer">
                    <h2> @lang('web.call_us')</h2>
                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-location-dot"></i>
                            @if(App::getLocale() == 'ar')
                                {{ settings()['address_ar'] }}
                            @else
                                {{ settings()['address_en'] }}
                            @endif
                        </li>
                        <li><i class="fa-solid fa-phone-flip"></i> {{settings()['phone']}}</li>
                        <li><i class="fa-brands fa-whatsapp"></i> {{settings()['whatsup']}}</li>
                        <li><i class="fa-solid fa-envelope"></i> {{ settings()['email'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="copy_right">
            <div class="d-md-flex align-items-md-center justify-content-md-between">
                <p class="mb-0">جميع الحقوق محفوظة &copy; 2021</p>
                <a href=""><img src="{{asset('web/assets/images/topline.png')}}" alt=""></a>
            </div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{asset('web/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="{{asset('web/assets/js/script.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.34/sweetalert2.min.js"></script>
@yield('js')
<script>
    jQuery(document).ready(function ($) {
        var lang = "{{App::getLocale()}}";
        console.log(lang);
        if(lang == 'en'){
            $("[hreflang=en]").hide();
        }else{
            $("[hreflang=ar]").hide();
        }
    });
</script>

</body>

</html>
