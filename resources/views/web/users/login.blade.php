@extends('web.layouts.master')
@section('title')
    |
    @lang('web.login')
@endsection
@section('content')

    <div class="entry-content forms-user">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form">
                        <h3 class="text-center"> @lang('web.login')</h3>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ LaravelLocalization::localizeUrl('postLogin') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="phone" class="form-control" id="" placeholder="********05">
                            </div>
                            <div class="mb-3 position-relative">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder=" {{__('web.password')}}">
                                <button id="show_pass"><i class="fa-solid fa-eye eye"></i></button>
                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                <a href="{{LaravelLocalization::localizeUrl('forgetPassword')}}">@lang('web.forgetPassword')</a>
                                <input type="submit" value="{{__('web.signin')}}" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
