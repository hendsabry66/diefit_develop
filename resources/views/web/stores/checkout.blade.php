@extends('web.layouts.master')
@section('title')
    |

    @lang('web.completeOrder')
@endsection
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسية</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('web.completeOrder')</li>
            </ol>
        </nav>
    </div>

    <div class="notification cart checkout mt-5">
        <div class="container">
            <div class="head text-center">
                <h2>إتمام الطلب (CheckOut)</h2>
            </div>
            <div id="box">
                <div class="items">
                    <div class="head">
                        <h2>@lang('web.Order Summary')</h2>
                    </div>
                    @foreach($carts as $cart)
                        <div class="item mb-4">
                            <div class="d-md-flex">
                                <figure>
                                    <img src="{{$cart->product->image}}" alt="">
                                </figure>
                                <div class="caption">
                                    <h2>{{$cart->product->name}}</h2>
                                    <ul>
                                        <li>@lang('web.quantity') : <strong> {{$cart->quantity}}</strong></li>
                                        <li>@lang('web.price'): <strong>{{$cart->price}} @lang('web.rial')</strong></li>
                                    </ul>
                                </div>
                            </div>
    {{--                        <a href="{{url('store/removeCart/'.$cart->id)}}"><i class="fa-solid fa-xmark"></i></a>--}}
                            <a class="btn btn-default btn-confirm" data-id="{{$cart->id}}" id="{{$cart->id}}"><i class="fa-solid fa-xmark"></i></a>
                            <!-- Model -->
                            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            {{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                                            <h4 class="modal-title" id="myModalLabel">@lang('web.Are you sure to delete?')</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" id="modal-btn-si">@lang('web.yes')</button>
                                            <button type="button" class="btn btn-primary" id="modal-btn-no">@lang('web.no')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Model -->
                        </div>
                    @endforeach


                </div>

                <div class="alert alert-secondary mt-5" role="alert">
                <div class="head">
                    <h2>@lang('web.order invoice')</h2>
                </div>
                    @php $total = 0 ;
                         foreach($carts as $cart){
                      $total += $cart->price * $cart->quantity ;
                      }

                    @endphp
                <ul>
                    <li>
                        <div class="d-flex justify-content-between">
                            <span>@lang('web.total_base_price') </span>
                            <span>{{$total }} @lang('web.rial')</span>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex justify-content-between">
                            <span> @lang('web.delivery_price') </span>
                            <span> 0 @lang('web.rial')</span>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex justify-content-between">
                            <span>@lang('web.tax') </span>
                            <span>{{(15* ($total+ 0) ) / 100}} @lang('web.rial') </span>
                        </div>
                    </li>
                    <li>
                        <div class="d-flex justify-content-between">
                            <span>@lang('web.total_price')</span>

                            <span><strong>{{$total+ 0  + ((15* ($total+ 0) ) / 100)}}  @lang('web.rial')</strong></span>
                        </div>
                    </li>
                </ul>
            </div>
            </div>

            <form action="{{url('store/save/order')}}"  method="post" class="form-checkout mt-5 clearfix">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="head">
                            <h2>@lang('web.address_of_order') </h2>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-3"><strong>@lang('web.city')</strong></label>
                            <select class="form-select" aria-label="Default select example" name="city_id" required>
                                <option>@lang('web.choose')</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-3"><strong>@lang('web.Description_and_title_tag') </strong></label>
                            <input class="form-control" type="text" name="address" id="" placeholder="@lang('web.address')" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-3"><strong>@lang('web.street') </strong></label>
                            <input class="form-control" type="text" name="street" id="" placeholder="@lang('web.street')" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-3"><strong>@lang('web.house') </strong></label>
                            <input class="form-control" type="text" name="house" id="" placeholder="@lang('web.house')" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-3"><strong>@lang('web.apartment') </strong></label>
                            <input class="form-control" type="text" name="apartment" id="" placeholder="@lang('web.apartment')" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="head">
                            <h2>@lang('web.Right time for delivery')  </h2>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-3"><strong>@lang('web.day') </strong></label>
                            <input class="form-control" type="date" name="date" id="" placeholder="" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-3"><strong>@lang('web.hour') </strong></label>
                            <input class="form-control" type="time" name="time" id="" placeholder="00:00" required>
                        </div>
{{--                        <hr>--}}
{{--                        <div class="head">--}}
{{--                            <h2>@lang('web.Select the appropriate payment method') </h2>--}}
{{--                        </div>--}}
{{--                        @foreach(json_decode(settings()['store_payment']) as $payment_method)--}}

{{--                            <div class="form-check">--}}
{{--                                <input class="form-check-input" type="radio" name="payment" value="visa" id="flexRadioDefault1" required>--}}
{{--                                <label class="form-check-label" for="flexRadioDefault1">--}}
{{--                                    {{$payment_method}}--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
                    </div>
                </div>
                <div class="float-end">
                    <input class="btn btn-success" type="submit" value="@lang('web.Complete the order')">
                </div>
            </form>


        </div>
    </div>

  @endsection
@section('js')
    <script>
        var cart_id;
        var modalConfirm = function (callback) {
            $(".btn-confirm").on("click", function () {
                cart_id = $(this).data('id');
                $("#mi-modal").modal("show");
            });

            $("#modal-btn-si").on("click", function () {
                callback(true);
                $("#mi-modal").modal("hide");
            });

            $("#modal-btn-no").on("click", function () {
                callback(false);
                $("#mi-modal").modal("hide");
            });
        };

        modalConfirm(function (confirm) {
            if (confirm) {
                $.ajax({
                    method: "get",
                    url: "{{ url('store/removeCart/') }}/" + cart_id,
                    dataType: "json",
                    cache: false,
                    success: function (response) {
                        $("#box").load(location.href + " #box");
                        // $("#box").load('#box');

                    }
                });

            }
        });
    </script>
@endsection
