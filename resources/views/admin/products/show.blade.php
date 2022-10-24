@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.products')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('products.index')}}"> @lang('admin.products')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.addProduct')
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
                            @if(!empty($product->image))
                                <img class=" img-fluid mb-1" width="100" src="{{$product->image}}" alt="Card image cap">
                            @endif
                            <h4 class="card-title"># {{$product->id}} </h4>
                            <p class="card-text"><span>  @lang('admin.name_ar') :- </span>{{$product->getTranslations('name')['ar']}}</p>
                            <p class="card-text"><span>  @lang('admin.name_en') :- </span>{{$product->getTranslations('name')['en']}}</p>


                            <p class="card-text"><span>  @lang('admin.details_ar') :- </span>{!! $product->getTranslations('details')['ar'] !!}</p>
                            <p class="card-text"><span>  @lang('admin.details_en') :- </span>{!!$product->getTranslations('details')['en'] !!}</p>
                            <p class="card-text"><span> القسم  :- </span>{{($product->productCategory)? $product->productCategory->getTranslations('name')['ar'] : '-'}}</p>

                            <p class="card-text"><span> @lang('admin.price')  :- </span> {{$product->price}}</p>
                            <p class="card-text"><span> @lang('admin.qty')  :- </span>{{$product->qty}}</p>

                           <a href="{{route('products.edit',$product->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
