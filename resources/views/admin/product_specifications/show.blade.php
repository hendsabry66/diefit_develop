@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.ProductSpecification')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('ProductSpecification.index')}}"> @lang('admin.ProductSpecification')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.addProductSpecification')
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

                            <h4 class="card-title"># {{$productSpecification->id}} </h4>
                            <p class="card-text"><span>  @lang('admin.value_ar') :- </span>{{$productSpecification->getTranslations('value')['ar']}}</p>
                            <p class="card-text"><span>  @lang('admin.value_en') :- </span>{{$productSpecification->getTranslations('value')['en']}}</p>
                            <p class="card-text"><span>  @lang('admin.product') :- </span>{{$productSpecification->product->getTranslations('name')['en']}}</p>
                            <p class="card-text"><span>  @lang('admin.category') :- </span>{{$productSpecification->product_specification_category->getTranslations('name')['en']}}</p>

                           <a href="{{route('ProductSpecification.edit',$productSpecification->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
