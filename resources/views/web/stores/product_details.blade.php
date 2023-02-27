@extends('web.layouts.master')
@section('title')
    |
    {{$product->name}}
@endsection
@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">@lang('web.home')</a></li>
                <li class="breadcrumb-item"><a href="{{url('store')}}">{{$product->productCategory->name}} </a></li>
                <li class="breadcrumb-item"><a href="{{url('storeProducts/'.$product->productCategory->id)}}">@lang('web.products')</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{$product->name}}</li>
            </ol>
        </nav>
    </div>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif
    @if(Session::has('error'))
        <div class="alert alert-danger text-center">
            {{Session::get('error')}}
        </div>
    @endif
    <div class="products single-product mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="d-flex gallery">
                        <div thumbsSlider="" class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach($product->images as $image)
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
                                @foreach($product->images as $image)
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
                            <h2>{{$product->name}}</h2>
                        </div>
                        <div class="mb-4">
                           {!! $product->details !!}
                        </div>
                        <div class="options">
                            <div class="color mb-4">
                                <form method="post" action="{{LaravelLocalization::localizeUrl('store/addCart')}}" >
                                @foreach(array_unique($product->categorySpecifications($product->id)) as$category)
                                    <span>{{$category->name}}: </span>
                                    <select class="form-control" name="{{$category->name}}">
                                        @foreach($product->specifications()->where('product_specification_category_id',$category->id)->where('product_id',$product->id)->get() as $specification)

                                            <option value="{{$specification->value}}">{{$specification->value}}</option>
{{--                                        <div class="form-check form-check-inline">--}}
{{--                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"--}}
{{--                                            id="inlineRadio1" value="{{$specification->id}}">--}}
{{--                                        <label class="form-check-label" for="inlineRadio1">{{$specification->value}}</label>--}}
{{--                                    </div>--}}
                                        @endforeach
                                    <select>
                                    <br>
                                @endforeach
                            </div>
                            <div class="number mb-4">
                                <span>@lang('web.quantity'): </span>
                                <div class="d-flex align-items-center quantity">
                                    <button class="plus"><i class="fa-solid fa-plus"></i></button>
                                    <input type="number"  id="" name="quantity" class="qty " step="1" value="1" min="1" max="">
                                    <button class="min minus"><i class="fa-solid fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="price mb-4">
                                <span>@lang('web.price'): </span>
                                <strong>{{$product->price}} @lang('web.rial') </strong>
                            </div>
                            <div class="d-block d-md-flex">

                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="price" value="{{$product->price}}">
                                    <button type="submit" class="btn btn-success">@lang('web.confirmation')</button>

                                </form>
                                <form method="post" action="{{url('addFavorite')}}" id="favouritePost">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}" id="product_id">

{{--                                    @if($isFavorite)--}}
{{--                                    <button type="submit" class="btn btn-success favorite">@lang('web.add to favorite')</button>--}}
{{--                                        @else--}}
                                        <button type="submit" class="btn btn-warning favorite">@lang('web.add to favorite')</button>
{{--                                    @endif--}}
                                </form>
{{--                                <a href="" class="btn btn-warning favorite">@lang('web.add to favorites')</a>--}}
                                <a href="" class="btn btn-outline-secondary share">@lang('web.to share')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-5">
            <div class="mt-5">
                <div class="head">
                    <h2>@lang('web.similar products')</h2>
                </div>
                <div class="row">
                    @foreach($similarProducts as $similarProduct)
                    <div class="col-md-4 col-6">
                        <div class="item card-sile">
                            <a href="{{url('productDetails/'.$similarProduct->id)}}">
                                <figure><img src="{{$similarProduct->image}}" alt=""></figure>
                                <h3> {{$similarProduct->name }}</h3>
                            </a>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#favouritePost").submit(function (e) {
                e.preventDefault();

                var product_id = $("#product_id").val();
                $.ajax({
                    method: "post",
                    url: "{{ url('store/addFavorite') }}",
                    dataType: "json",
                    data: {product_id: product_id},
                    cache: false,
                    success: function (response) {
                        // alert('تم اضافة المنتج الي المفضلة');
                        // $('.favorite').removeClass("btn-warning").addClass("btn-success");
                        // $('.favorite').append('<p>تمت الاضافة الي المفضلة</p>');

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
