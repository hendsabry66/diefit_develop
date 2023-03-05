@extends('web.layouts.master')
@section('title')
    |
    @lang('web.forget password')
@endsection
@section('content')

    <div class="entry-content forms-user">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form">
                        <h3 class="text-center">@lang('web.restore password')</h3>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ LaravelLocalization::localizeUrl('forgetPassword') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="phone" class="form-control" id="" placeholder="********05">
                            </div>

                            <div class="d-flex align-items-center justify-content-end">
                                <input type="submit" value="{{__('web.send')}}" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
