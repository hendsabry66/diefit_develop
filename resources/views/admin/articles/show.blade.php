@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.articles')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('articles.index')}}"> @lang('admin.articles')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.addArticle')
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
                            @if(!empty($article->image))
                                <img class=" img-fluid mb-1" width="100" src="{{$image->name}}" alt="Card image cap">
                            @endif
                            <h4 class="card-title"># {{$article->id}} </h4>
                            <p class="card-text"><span>  @lang('admin.title_ar') :- </span>{{$article->getTranslations('title')['ar']}}</p>
                            <p class="card-text"><span>  @lang('admin.title_en') :- </span>{{$article->getTranslations('title')['en']}}</p>

                            <p class="card-text"><span>  @lang('admin.short_description_ar') :- </span>{{$article->getTranslations('short_description')['ar']}}</p>
                            <p class="card-text"><span>  @lang('admin.short_description_en') :- </span>{{$article->getTranslations('short_description')['en']}}</p>

                            <p class="card-text"><span>  @lang('admin.details_ar') :- </span>{{$article->getTranslations('details')['ar']}}</p>
                            <p class="card-text"><span>  @lang('admin.details_en') :- </span>{{$article->getTranslations('details')['en']}}</p>
                            <p class="card-text"><span> القسم  :- </span>{{($article->articleCategory)? $article->articleCategory->getTranslations('name')['ar'] : '-'}}</p>
                            <p class="card-text"><span> @lang('admin.user')  :- </span>{{($article->user)? $article->user->name : '-'}}</p>
                           <a href="{{route('articles.edit',$article->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
