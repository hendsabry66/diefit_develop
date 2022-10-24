@extends('web.layouts.master')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('web.home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('web.favourites')</li>
            </ol>
        </nav>
    </div>

    <div class="products mt-5">
        <div class="container">
            <ul class="nav nav-tabs" id="favourite" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">الوجبات</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">المتجر</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0" id="food_box">
                    <div class="row">
                        @foreach ($foods as $food)
                            <div class="col-md-4 col-6">
                                <div class="item card-sile favourite">
                                   {{-- <a href="" class="remove" data-title="ازالة من المفضلة"><i class="fa-solid fa-xmark"></i></a> --}}
                                        <a class="remove btn-confirm" data-title="ازالة من المفضلة" data-id="{{$food->id}}" id="{{$food->id}}"><i class="fa-solid fa-xmark"></i></a>
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
                                    <a href="{{ url('restaurant/foodDetails/' . $food->id) }}">
                                        <figure>
                                            @if ($food->image)
                                                <img src="{{ $food->image }}" alt="">
                                            @else
                                                <img src="{{ asset('web/assets/images/c01.png') }}" alt="">
                                            @endif
                                        </figure>
                                        <h3> {{ $food->name }}</h3>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0" id="product_box">
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-md-4 col-6">
                                <div class="item card-sile favourite">
                                   {{-- <a href="" class="remove" data-title="ازالة من المفضلة"><i class="fa-solid fa-xmark"></i></a> --}}
                                    <a class="remove btn-confirm_product" data-title="ازالة من المفضلة" data-id="{{$product->id}}" id="{{$product->id}}"><i class="fa-solid fa-xmark"></i></a>
                        <!-- Model -->
                        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal-product">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        {{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                                        <h4 class="modal-title" id="myModalLabel">@lang('web.Are you sure to delete?')</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" id="modal-btn-si-product">@lang('web.yes')</button>
                                        <button type="button" class="btn btn-primary" id="modal-btn-no-product">@lang('web.no')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Model -->
                                    <a href="{{ url('store/productDetails/' . $product->id) }}">
                                        <figure>
                                            @if ($product->image)
                                                <img src="{{ $product->image }}" alt="">
                                            @else
                                                <img src="{{ asset('web/assets/images/c01.png') }}" alt="">
                                            @endif
                                        </figure>
                                        <h3> {{ $product->name }}</h3>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        var food_id;
        var modalConfirm = function (callback) {
            $(".btn-confirm").on("click", function () {
                food_id = $(this).data('id');
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
                    url: "{{ url('restaurant/removeFavorite/') }}/" + food_id,
                    dataType: "json",
                    cache: false,
                    success: function (response) {
                        $("#food_box").load(location.href + "#food_box");
                        // $("#box").load('#box');

                    }
                });

            }
        });
      //product
      
       var product_id;
        var modalConfirm_product = function (callback) {
            $(".btn-confirm_product").on("click", function () {
                product_id = $(this).data('id');
                $("#mi-modal-product").modal("show");
            });

            $("#modal-btn-si-product").on("click", function () {
                callback(true);
                $("#mi-modal-product").modal("hide");
            });

            $("#modal-btn-no-product").on("click", function () {
                callback(false);
                $("#mi-modal-product").modal("hide");
            });
        };

        modalConfirm(function (confirm) {
            if (confirm) {
                $.ajax({
                    method: "get",
                    url: "{{ url('store/removeFavorite/') }}/" + product_id,
                    dataType: "json",
                    cache: false,
                    success: function (response) {
                        $("#product_box").load(location.href + "#product_box");
                        // $("#box").load('#box');

                    }
                });

            }
        });
    </script>
@endsection
