@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.videos')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('videos.index')}}"> @lang('admin.videos')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.addVideo')
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
                <div class="card" style="">
                    <div class="card-content">
                        <div class="card-body">
                            @if(!empty($video->image))
                                <img class=" img-fluid mb-1" width="100" src="{{$image->name}}" alt="Card image cap">
                            @endif
                            <h4 class="card-title"># {{$video->id}} </h4>
                            <p class="card-text"><span>  @lang('admin.title_ar') :- </span>{{$video->getTranslations('title')['ar']}}</p>
                            <p class="card-text"><span>  @lang('admin.title_en') :- </span>{{$video->getTranslations('title')['en']}}</p>

                            <p class="card-text"><span>  @lang('admin.short_description_ar') :- </span>{{$video->getTranslations('short_description')['ar']}}</p>
                            <p class="card-text"><span>  @lang('admin.short_description_en') :- </span>{{$video->getTranslations('short_description')['en']}}</p>

                            <p class="card-text"><span>  @lang('admin.details_ar') :- </span>{{$video->getTranslations('details')['ar']}}</p>
                            <p class="card-text"><span>  @lang('admin.details_en') :- </span>{{$video->getTranslations('details')['en']}}</p>
                            <p class="card-text"><span> القسم  :- </span>{{($video->videoCategory)? $video->videoCategory->getTranslations('name')['ar'] : '-'}}</p>
                            <p class="card-text"><span> @lang('admin.user')  :- </span>{{($video->user)? $video->user->name : '-'}}</p>
                           <a href="{{route('videos.edit',$video->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
