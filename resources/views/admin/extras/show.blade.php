@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.extras')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('extras.index')}}"> @lang('admin.extras')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.addExtra')
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
                            <h4 class="card-title"># {{$extra->id}} </h4>
                            <p class="card-text"><span>  @lang('admin.name_ar') :- </span>{{$extra->getTranslations('name')['ar']}}</p>
                            <p class="card-text"><span>  @lang('admin.name_en') :- </span>{{$extra->getTranslations('name')['en']}}</p>

                            <p class="card-text"><span>  @lang('admin.details_ar') :- </span>{!! $extra->getTranslations('details')['ar'] !!}</p>
                            <p class="card-text"><span>  @lang('admin.details_en') :- </span>{!!$extra->getTranslations('details')['en'] !!}</p>
                            <p class="card-text"><span> @lang('admin.price')  :- </span> {{$extra->price}}</p>
                          <p class="card-text"><span> @lang('admin.numberOfCalories')  :- </span>{{$extra->numberOfCalories}}</p>
                            <p class="card-text"><span> @lang('admin.fat_percentage')  :- </span>{{$extra->fat_percentage}}</p>
                            <p class="card-text"><span> @lang('admin.carbohydrate_percentage')  :- </span>{{$extra->carbohydrate_percentage}}</p>
                            <p class="card-text"><span> @lang('admin.protein_percentage')  :- </span>{{$extra->protein_percentage}}</p>

                           <a href="{{route('extras.edit',$extra->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
