@extends('web.layouts.master')
@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">@lang('web.home')</a></li>
                <li class="breadcrumb-item"><a href="{{url('/subscriptions')}}">@lang('web.subscriptions')</a></li>
                <li class="breadcrumb-item active" aria-current="page"> @lang('web.subscription_confirm')</li>
            </ol>
        </nav>
    </div>

    <div class="participation-confirmation">
        <div class="container">
            <div class="head">
                <h2>  @lang('web.subscription_confirm')</h2>
            </div>
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <div class="entry-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="box">
                            <div class="d-flex justify-content-between align-items-center header">
                                <div>
                                    <h4>@lang('web.cost')</h4>
                                    <p>{{$subscriptionPrice->subscription->name}} -
                                        @foreach(json_decode($subscriptionPrice->food_type) as $foodType)
                                            {{\App\Models\FoodType::find($foodType)->name}} ,
                                        @endforeach
                                    </p>
                                </div>
                                <div>{{$subscriptionPrice->price}}</div>
                            </div>
                            <hr>
                            <h4> @lang('web.payment_method')</h4>
                            <p>@lang('web.Choose the payment method that suits you')</p>
                            <form method="post" action="{{url('subscriptions/store')}}">
                                @csrf
                                <input type="hidden" name="subscription_price_id" value="{{$subscriptionPrice->id}}">
                                <div class="form-check form-check-inline payment-menthod bank-accounts">
                                    <input class="form-check-input" type="radio" name="payment" id="inlineRadio1"
                                           value="bank">
                                    <label class="form-check-label" for="inlineRadio1"><img src="{{asset('web/assets/images/bank.png')}}"
                                                                                            alt=""></label>
                                </div>
                                <div class="form-check form-check-inline payment-menthod online-payments">
                                    <input class="form-check-input" type="radio" name="payment" id="inlineRadio2"
                                           value="visa">
                                    <label class="form-check-label" for="inlineRadio2"><img src="{{asset('web/assets/images/visa.png')}}"
                                                                                            alt=""></label>
                                </div>
                                <div class="form-check form-check-inline payment-menthod online-payments">
                                    <input class="form-check-input" type="radio" name="payment" id="inlineRadio3"
                                           value="mastercard">
                                    <label class="form-check-label" for="inlineRadio3"><img
                                            src="{{asset('web/assets/images/mastercard.png')}}" alt=""></label>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-6" id="bank-account-details" style="display:none">
                        <div class="box">
                            <div class="d-flex justify-content-between align-items-center header">
                                <div>
                                    <h4> @lang('web.subscription_details')</h4>
                                    <p>@lang('web.Enter the information below to confirm the payment of the amount of')</p>
                                </div>
                                <div>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#bankModal" class="btn btn-outline-warning"> @lang('web.bank_accounts')</a>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control" placeholder="@lang('web.Converter name')">
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="bank_id" aria-label="Default select example">
                                    <option selected>@lang('web.Choose the bank')</option>
                                    @foreach($bankAccounts as $bank)
                                        <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                    @endforeach
                                </select>
{{--                                <input type="text" name="account_number" class="form-control" placeholder="@lang('web.Account number transferred from')">--}}
                            </div>
                            <div class="mb-3">
                                <input type="text" name="amount" class="form-control" placeholder="@lang('web.Transfer amount')">
                            </div>
{{--                            <div class="mb-3">--}}
{{--                                <input type="text" name="ipan" class="form-control" placeholder="@lang('web.ipan')">--}}
{{--                            </div>--}}
                            <div class="mb-3">
                                <input type="file" name="image" class="form-control" placeholder="@lang('web.image')">
                            </div>

                        </div>
                    </div>
                </div>
                <input class="btn btn-warning" type="submit" value="@lang('web.subscription')">
                </form>
            </div>

        </div>
    </div>


    <div class="modal fade" id="bankModal" tabindex="-1" aria-labelledby="bankModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bankModalLabel">الحسابات البنكية</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach($bankAccounts as $bankAccount)
                        <p><span>@lang('web.bank_name')</span> : - {{$bankAccount->bank_name}}</p>
                        <p><span>@lang('web.account_number')</span> : - {{$bankAccount->account_number}}</p>
                        <p><span>@lang('web.account_iban')</span> : - {{$bankAccount->account_iban}}</p>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
