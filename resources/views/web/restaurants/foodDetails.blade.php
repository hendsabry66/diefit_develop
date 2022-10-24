@extends('web.layouts.master')
@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">@lang('web.home')</a></li>
                <li class="breadcrumb-item"><a href="{{url('restaurant')}}">{{$food->foodCategory->name}} </a></li>
                <li class="breadcrumb-item"><a href="{{url('restaurant/foods/'.$food->foodCategory->id)}}">@lang('web.foods')</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{$food->name}}</li>

            </ol>
        </nav>
    </div>

    <div class="products single-product mt-5">
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            @endif            <div class="row">
                <div class="col-lg-5">
                    <div class="d-flex gallery">
                        <div thumbsSlider="" class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach($food->images as $image)
                                    <div class="swiper-slide">
                                        <figure>
                                            <img src="{{$image->image}}" alt="">
                                        </figure>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                        <div class="swiper mySwiper2">
                            <div class="swiper-wrapper">
                                @foreach($food->images as $image)
                                    <div class="swiper-slide">
                                        <figure>
                                            <img src="{{$image->image}}" alt="">
                                        </figure>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="content mt-4 mt-md-0">
                        <div class="head">
                            <h2>{{$food->name}}</h2>
                        </div>
                        <div class="mb-4">
                            {!! $food->details !!}
                        </div>
                        <div class="more-info mb-3">
                            <h3>@lang('web.ingerdients'):</h3>
                            <p class="mb-0">{!! $food->ingredients !!}</p>
                        </div>
                        <div class="options">
                            <form method="post" action="{{LaravelLocalization::localizeUrl('restaurant/addCart')}}" >
                                <div class="number mb-4">
                                    <span>@lang('web.quantity'): </span>
                                    <div class="d-flex align-items-center quantity">
                                        <button class="plus"><i class="fa-solid fa-plus"></i></button>
                                        <input type="number"  id="" name="quantity" class="qty" step="1" value="1" min="1" max="">
                                        <button class="min minus"><i class="fa-solid fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="price mb-4">
                                    <span>@lang('web.price'): </span>
                                    <strong>{{$food->price}}</strong>
                                </div>
                                <div class="d-block d-md-flex">

                                    @csrf
                                    <input type="hidden" name="food_id" value="{{$food->id}}">
                                    <input type="hidden" name="price" value="{{$food->price}}">
                                    <input type="hidden" name="extra[]" value="[]">
                                    <button type="submit" class="btn btn-success">@lang('web.confirmation')</button>

                            </form>
                            <form method="post" action="{{url('addFavorite')}}" id="favouritePost">
                                @csrf
                                <input type="hidden" name="food_id" value="{{$food->id}}" id="food_id">
                                {{--                                    @if($isFavorite)--}}
                                {{--                                        <button type="submit" class="btn btn-success favorite">@lang('web.add to favorite')</button>--}}
                                {{--                                    @else--}}
                                <button type="submit" class="btn btn-warning favorite">@lang('web.add to favorite')</button>
                                {{--                                    @endif--}}
                            </form>
                            <a href="" class="btn btn-outline-secondary share">@lang('web.share')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-information">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <div class="head">
                            <h2> @lang('web.nutritional_factors')</h2>
                        </div>
                        {{--                            <p>عدد الحصص في العبوة : <strong>1</strong></p>--}}
                        {{--                            <p>حجم الحصة : <strong>100 غرام</strong></p>--}}
                        {{--                            <div class="alert alert-secondary mb-3 mt-3">--}}
                        {{--                                <p>الكمية لكل حصة</p>--}}
                        {{--                                <h3>السعرات الحرارية 256</h3>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="float-end mb-3">--}}
                        {{--                                <p>نسبة الاحتياج اليومي %</p>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="clearfix"></div>--}}
                        <ul>

                            <li>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span><strong>  @lang('web.numberOfCalories') </strong></span>
                                    <span>{{$food->numberOfCalories}}%</span>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span>  @lang('web.fat_percentage') </span>
                                    <span>{{$food->fat_percentage}}%</span>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span>  @lang('web.protein_percentage')</span>
                                    <span>{{$food->protein_percentage}}%</span>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span><strong> @lang('web.Carbohydrate_percentage') </strong></span>
                                    <span>{{$food->Carbohydrate_percentage}}%</span>
                                </div>
                            </li>

                        </ul>
                        {{--                            <div class="alert alert-success">--}}
                        {{--                                <span class="text-success">نسبة الاستهلاك اليومي مبنية على النظام الغذائي المحتوى--}}
                        {{--                                    على 2000 سعرة حرارية.</span>--}}
                        {{--                            </div>--}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="head">
                        <h2>@lang('web.Determine meal-specific factors')</h2>
                    </div>
                    <form action="">
                        @foreach($food->extras as $extra)
                            <div class="mb-3">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected> {{$extra->name}}</option>
                                    @foreach($extra->values as $value)
                                        <option value="{{$value->id}}">{{$value->value}}</option>
                                    @endforeach

                                </select>
                            </div>
                        @endforeach

                    </form>
                    {{--                        <div class="alert alert-success">--}}
                    {{--                            <span>الإضافات تكون بقدار 50 جرام في كل مرة</span>--}}
                    {{--                        </div>--}}
                </div>
            </div>
        </div>

        <hr class="mt-5">
        <div class="mt-5">
            <div class="head">
                <h2> @lang('web.similar products')</h2>
            </div>
            <div class="row">
                @foreach($similarFoods as $food)
                    <div class="col-md-4 col-6">
                        <div class="item card-sile mb-4">
                            <a href="{{url('restaurant/foodDetails/'.$food->id)}}">
                                <figure>
                                    @if(!empty($food->image))
                                        <img src="{{$food->image}}" alt="">
                                    @else
                                        <img src="{{asset('web/assets/images/i01.png')}}" alt="">
                                    @endif

                                </figure>
                                <h3> {{$food->name}}</h3>
                            </a>
                            <div class="content">
                                <p>{!! $food->details !!}</p>
                                <div class="price text-warning">{{$food->price}} ريال</div>
                                <form method="post" action="{{url('addFavorite')}}" id="favouritePost">
                                    @csrf
                                    <input type="hidden" name="food_id" value="{{$food->id}}" id="food_id">
                                    {{--                                    @if($isFavorite)--}}
                                    {{--                                        <button type="submit" class="btn btn-success favorite">@lang('web.add to favorite')</button>--}}
                                    {{--                                    @else--}}
                                    <button type="submit" class="btn btn-warning favorite">@lang('web.add to favorite')</button>
                                    {{--                                    @endif--}}
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var arr = [];
            $('select').on('change', function() {
                arr = this.value ;

                $('input:hidden[name=extra]').val(arr);
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#favouritePost").submit(function (e) {
                e.preventDefault();

                var food_id = $("#food_id").val();
                $.ajax({
                    method: "post",
                    url: "{{ url('restaurant/addFavorite') }}",
                    dataType: "json",
                    data: {food_id: food_id},
                    cache: false,
                    success: function (response) {
                        // $('.favorite').append('<p>تمت الاضافة الي المفضلة</p>');
                        //
                        // alert('تم اضافة المنتج الي المفضلة');
                               var lang = "{{App::getLocale()}}";

                        if(lang == 'en'){
                            Swal.fire({
                                title: 'success!',
                                text: 'added to favorite',
                                icon: 'success',
                                confirmButtonText: 'ok'
                            });
                        }else{
                            Swal.fire({
                                title: 'تم  !',
                                text: 'تم الاضافه الي المفضله ',
                                icon: 'success',
                                confirmButtonText: 'نعم'
                            });
                        }
                        // console.log(response);
                    }
                });
            });
        });

        jQuery(document).ready(function ($) {
    $(document).on('click', 'button.plus, button.minus', function (e) {

        var qty = $(this).parent('.quantity').find('.qty');
        var val = parseFloat(qty.val());
        var max = parseFloat(qty.attr('max'));
        var min = parseFloat(qty.attr('min'));
        var step = parseFloat(qty.attr('step'));

        if ($(this).is('.plus')) {
            if (max && (max <= val)) {
                qty.val(max).change();
            } else {
                qty.val(val + step).change();
            }
        } else {
            if (min && (min >= val)) {
                qty.val(min).change();
            } else if (val > 1) {
                qty.val(val - step).change();
            }
        }
return false;
    });
});

    </script>
@endsection
