@extends('web.layouts.master')
@section('title', 'Code')
@section('content')

    <div class="entry-content forms-user">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form">
                        <h3 class="text-center"> @lang('web.contact')</h3>
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
                        <form method="POST" action="{{ LaravelLocalization::localizeUrl('contact') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="subject" class="form-control" id="" placeholder=" {{__('web.subject')}}">
                            </div>
                            <div class="mb-3 position-relative">
                                <textarea name="message" id="" cols="30" rows="10" class="form-control" placeholder=" {{__('web.message')}}"></textarea>


                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                  <input type="submit" value="{{__('web.send')}}" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
