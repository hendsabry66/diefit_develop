@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.videoCategories')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('video_categories.index')}}"> @lang('admin.videoCategories')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.addVideoCategory')
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
                            @if(!empty($videoCategory->image))
                             <img class=" img-fluid mb-1" width="100" src="{{$videoCategory->image}}" alt="Card image cap">
                            @endif
                            <h4 class="card-title"># {{$videoCategory->id}} </h4>
                            <p><span>@lang('admin.name_ar')</span>{{$videoCategory->getTranslations('name')['ar'] }}</p>
                            <p><span>@lang('admin.name_en')</span>{{$videoCategory->getTranslations('name')['en'] }}</p>
                            <p class="card-text"><span> القسم الاساسي :- </span>{{($videoCategory->parent)? $videoCategory->parent->name : '-'}}</p>
                            <p class="card-text"><span>  الحالة :- </span>
                                @if($videoCategory->status == 'active')
                                    <span class="badge badge-success">@lang('admin.active')</span>
                                @else
                                    <span class="badge badge-danger">@lang('admin.in_active')</span>
                                @endif
                            </p>
                            <a href="{{route('video_categories.edit',$videoCategory->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
