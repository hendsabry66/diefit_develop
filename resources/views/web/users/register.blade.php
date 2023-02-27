@extends('web.layouts.master')
@section('title')
    |
    @lang('web.register')
@endsection
@section('content')

    <div class="entry-content forms-user">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form">
                        <h3 class="text-center"> @lang('web.register')</h3>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{LaravelLocalization::localizeUrl('postRegister')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control" id="" placeholder=" {{__('web.name')}}">
                            </div>
                            <div class="mb-3">
                                <input type="text" name="phone" class="form-control" id="" placeholder="  {{__('web.phone')}}">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" id="" placeholder=" {{__('web.email')}}">
                            </div>
                            <div class="mb-3 position-relative">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="  {{__('web.password')}}">
                                <button id="show_pass"><i class="fa-solid fa-eye eye"></i></button>
                            </div>
                            <div class="mb-4">
                                <select class="form-control" name="city_id">
                                    <option value="">@lang('web.choose')</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                </select>
                                 </div>
                            <div class="mb-5">
                                <p class="mb-0">@lang('web.By subscribing, you agree to') <strong><a href=""> @lang('web.terms and conditions')</a></strong>
                                </p>
                            </div>
                            <div class="d-flex align-items-center justify-content-end">
                                <input type="submit" value="{{__('web.register')}}" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
