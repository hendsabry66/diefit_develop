@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.productCategories')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('productCategories.index')}}"> @lang('admin.productCategories')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.addProductCategory')
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
                            @if(!empty($productCategory->image))
                             <img class=" img-fluid mb-1" width="100" src="{{$productCategory->image}}" alt="Card image cap">
                            @endif
                            <h4 class="card-title"># {{$productCategory->id}} </h4>
                            <p><span>@lang('admin.name_ar')</span>{{$productCategory->getTranslations('name')['ar'] }}</p>
                            <p><span>@lang('admin.name_en')</span>{{$productCategory->getTranslations('name')['en'] }}</p>
                            <p class="card-text"><span> القسم الاساسي :- </span>{{($productCategory->parent)? $productCategory->parent->name : '-'}}</p>
                            <p class="card-text"><span>  الحالة :- </span>
                                @if($productCategory->status == 'active')
                                    <span class="badge badge-success">@lang('admin.active')</span>
                                @else
                                    <span class="badge badge-danger">@lang('admin.in_active')</span>
                                @endif
                            </p>
                            <a href="{{route('productCategories.edit',$productCategory->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
