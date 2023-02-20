@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.subscriptions')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('subscriptions.index')}}"> @lang('admin.subscriptions')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.editSubscription')
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <section id="horizontal-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-content collpase show">
                        <div class="card-body">

                            <form class="form form-horizontal ajaxForm" action="{{route('subscriptionFoods.update', $subscriptionFoodType->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i>  @lang('admin.editSubscriptionfoods') </h4>

                                    @include('admin.subscriptionfoods.edit_form')

                                </div>
                                <div class="form-actions ">
                                    <a href="{{route('subscriptions.index')}}" class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> @lang('admin.cancel')
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-check-square-o"></i> @lang('admin.save')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('select[name="subscription_id"]').on('change', function () {
                var subscription_id = $(this).val();
                if (subscription_id) {
                    $.ajax({
                        url: "{{ url('/admin/getSubscriptionDelivery/') }}/" + subscription_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="subscription_delivery_id"]').empty();
                            $('select[name="subscription_delivery_id"]').append('<option value=""> اختر</option>');
                            $.each(data, function (key, value) {
                                $('select[name="subscription_delivery_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="subscription_delivery_id"]').empty();
                }
            });

            $('select[name="subscription_delivery_id"]').on('change', function () {
                var subscription_delivery_id = $(this).val();

                $.ajax({
                    url: "{{ url('/admin/getSubscriptionFoods/') }}/" + subscription_delivery_id,
                    type: "GET",
                    dataType: "html",
                    success: function (data) {
                        $("#block").html(data);
                    },
                });

            });
        });

    </script>
@endsection
