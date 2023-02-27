@extends('web.layouts.master')
@section('title')
    |
    @lang('web.cart')
@endsection
@section('content')
    <div class="notification cart">
        <div class="container">
            <div class="head text-center">
                <h2> @lang('web.cart')</h2>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div id="box">
                @foreach ($carts as $cart)
                    <div class="items" id="cart_box_{{ $cart->id }}">
                        <div class="item mb-4">
                            <div class="d-md-flex">
                                <figure>
                                    <img src="{{ ($cart->food) ? $cart->food->image : null }}" alt="">
                                </figure>
                                <div class="caption">
                                    <h2>{{ $cart->food->name }} </h2>
                                    <p>{!! $cart->food->ingerdiants !!}</p>
                                    <ul class="cart-item-qty">
                                        <li class="number">
                                            <span>الكمية: </span>
                                            <div class="d-flex align-items-center quantity">
                                                <button class="plus change-qty"><i class="fa-solid fa-plus"></i></button>
                                                <input type="number" data-price="{{ $cart->price }}" class="qty" name="quantity"
                                                    value="{{ $cart->quantity }}" step="1" value="1"
                                                    min="1" max="">
                                                <button class="min minus change-qty"><i class="fa-solid fa-minus"></i></button>
                                            </div>
                                          <input type="hidden" name="total_price" value="{{ $cart->price * $cart->quantity }}" class="total-item-price" />
                                        </li>
                                      <li>السعر: <strong><span class="total-price-format">{{ $cart->price * $cart->quantity }}</span> ر.س</strong>
                                      </li>
                                    </ul>
                                </div>
                            </div>
                            {{--                    <a href="{{url('restaurant/removeCart/'.$cart->id)}}"  id="btn-confirm"><i class="fa-solid fa-xmark"></i></a> --}}
                            <a class="btn btn-default btn-confirm" data-id="{{ $cart->id }}" id="{{ $cart->id }}"><i
                                    class="fa-solid fa-xmark"></i></a>
                            <!-- Model -->
                            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                                aria-hidden="true" id="mi-modal">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            {{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
                                            <h4 class="modal-title" id="myModalLabel">@lang('web.Are you sure to delete?')</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                id="modal-btn-si">@lang('web.yes')</button>
                                            <button type="button" class="btn btn-primary"
                                                id="modal-btn-no">@lang('web.no')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


                <div class="total">
                    <div class="d-flex justify-content-between align-items-center">
                      @php $total = 0 ;
                         foreach($carts as $cart){
                      $total += $cart->price * $cart->quantity ;
                      }

                      @endphp



                      <span>@lang('web.total') : <strong><span class="total-cart-price-formats">{{ $total }}</span> ريال</strong></span>
                      	<input type="hidden" name="total_cart" value="{{ $total }}" class="total-cart-price" />
                        <a href="{{ url('restaurant/checkOut') }}" class="btn btn-success"> @lang('web.confirmation_of_purchase')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var cart_id;
        var modalConfirm = function(callback) {
            $(".btn-confirm").on("click", function() {
                cart_id = $(this).data('id');
                $("#mi-modal").modal("show");
            });

            $("#modal-btn-si").on("click", function() {
                callback(true);
                $("#mi-modal").modal("hide");
            });

            $("#modal-btn-no").on("click", function() {
                callback(false);
                $("#mi-modal").modal("hide");
            });
        };

        modalConfirm(function(confirm) {
            if (confirm) {
                $.ajax({
                    method: "get",
                    url: "{{ url('restaurant/removeCart/') }}/" + cart_id,
                    dataType: "json",
                    cache: false,
                    success: function(response) {
                        $("#box").load(location.href + " #box");
                        // $("#box").load('#box');

                    }
                });

            }
        });

        jQuery(document).ready(function($) {
            $(document).on('click', 'button.plus, button.minus', function(e) {

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
