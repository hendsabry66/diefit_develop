@extends('web.layouts.master')
@section('title', 'Code')
@section('content')

    <div class="entry-content forms-user">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form">
                        <h3 class="text-center mb-5">@lang('web.enter the activation code')</h3>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{LaravelLocalization::localizeUrl('postCode')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user_id}}">
                            <input type="hidden" name="type" value="{{$type}}">
                            <div class="mb-5 d-flex code">
                                <input type="number" name="number1" class="form-control code-input" id="" required>
                                <input type="number" name="number2" class="form-control code-input" id="" required>
                                <input type="number" name="number3" class="form-control code-input" id="" required>
                                <input type="number" name="number4" class="form-control code-input" id="" required>
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
