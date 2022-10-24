@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.users')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('users.index')}}"> @lang('admin.users')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.addUser')
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <section id="horizontal-form-layouts">
        <div class="row match-height">
            <div class=" col-sm-12">
                <div class="card" style="height: 399.797px;">
                    <div class="card-content">
                        <div class="card-body">

                            <h4 class="card-title"># {{$user->id}}  -  {{$user->name}}</h4>
                            <p class="card-text"><span>@lang('admin.email'):-</span>{{$user->email}}</p>
                            <p class="card-text"><span>@lang('admin.phone'):-</span>{{$user->phone}}</p>
                            <p class="card-text"><span>@lang('admin.user_type'):-</span>{{$user->user_type}}</p>

                            <p class="card-text"><span>  الحالة :- </span>
                                @if($user->status == 'active')
                                    <span class="badge badge-success">@lang('admin.active')</span>
                                @else
                                    <span class="badge badge-danger">@lang('admin.in_active')</span>
                                @endif
                            </p>
                            <a href="{{route('users.edit',$user->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
