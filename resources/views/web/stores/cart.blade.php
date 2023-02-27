@extends('web.layouts.master')
@section('content')

    <div class="notification cart">
        <div class="container">
            <div class="head text-center">
                <h2> @lang('web.cart')</h2>
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif
            <div id="box">
                <div class="items">

                    @foreach($carts as $cart)
                    <div class="item mb-4">
                        <div class="d-md-flex">
                            <figure>
                               <a href="{{LaravelLocalization::localizeUrl('productDetails/'.$cart->product->id)}}"> <img src="{{$cart->product->image}}" alt=""></a>
                            </figure>
                            <div class="caption">
                                <h2><a href="{{LaravelLocalization::localizeUrl('productDetails/'.$cart->product->id)}}"> {{$cart->product->name}} </a></h2>
                                <ul>
                                    <li>@lang('web.quantity') : <strong> {{$cart->quantity}}</strong></li>
                                    <li>@lang('web.price'): <strong>{{$cart->price}} @lang('web.rial')</strong></li>
                                </ul>
                            </div>
                        </div>
    {{--                    <a href="{{url('store/removeCart/'.$cart->id)}}" id="btn-confirm"><i class="fa-solid fa-xmark"></i></a>--}}
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

                <div class="total">
                <div class="d-flex justify-content-between align-items-center">
                    @php $total = 0 ;
                         foreach($carts as $cart){
                      $total += $cart->price * $cart->quantity ;
                      }

                      @endphp
                    <span>@lang('web.total') : <strong>{{$total }} @lang('web.rial')</strong></span>
                    <a href="{{url('store/checkOut')}}" class="btn btn-success">@lang('web.confirmation_of_purchase')</a>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- Model -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="modal-btn-si">Si</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
                </div>
            </div>
        </div>
    </div>

    <div class="alert" role="alert" id="result"></div>
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
