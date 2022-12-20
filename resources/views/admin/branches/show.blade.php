@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.branches')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('branches.index')}}"> @lang('admin.branches')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.addBranch')
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
                            <h4 class="card-title"># {{$branch->id}} </h4>
                            <p><span>@lang('admin.name') :- </span> {{ $branch->getTranslations('name')['ar'] }} - {{ $branch->getTranslations('name')['en'] }}</p>
                            <p class="card-text"><span>@lang('admin.address_ar')</span>{!!  $branch->getTranslations('address')['ar'] !!}</p>
                            <p class="card-text"><span>@lang('admin.address_en')</span>{!!  $branch->getTranslations('address')['en'] !!}</p>
                            <p class="card-text"><span>@lang('admin.city')</span>{{ $branch->city->getTranslations('name')['ar'] }}</p>
                            <p class="card-text"><span>@lang('admin.district')</span>{{ $branch->district->getTranslations('name')['ar'] }}</p>
                            <a href="{{route('branches.edit',$branch->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

@endsection
