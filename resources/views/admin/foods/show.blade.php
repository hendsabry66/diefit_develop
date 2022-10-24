@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.foods')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('foods.index')}}"> @lang('admin.foods')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.addFood')
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
                            @if(!empty($food->image))
                                <img class=" img-fluid mb-1" width="100" src="{{$food->image}}" alt="Card image cap">
                            @endif
                            <h4 class="card-title"># {{$food->id}} </h4>
                            <p class="card-text"><span>  @lang('admin.name_ar') :- </span>{{$food->getTranslations('name')['ar']}}</p>
                            <p class="card-text"><span>  @lang('admin.name_en') :- </span>{{$food->getTranslations('name')['en']}}</p>

                            <p class="card-text"><span>  @lang('admin.ingredients_ar') :- </span>{!! $food->getTranslations('ingredients')['ar'] !!}</p>
                            <p class="card-text"><span>  @lang('admin.ingredients_en') :- </span>{!! $food->getTranslations('ingredients')['en'] !!}</p>

                            <p class="card-text"><span>  @lang('admin.details_ar') :- </span>{!! $food->getTranslations('details')['ar'] !!}</p>
                            <p class="card-text"><span>  @lang('admin.details_en') :- </span>{!!$food->getTranslations('details')['en'] !!}</p>
                            <p class="card-text"><span> القسم  :- </span>{{($food->food_category)? $food->food_category->getTranslations('name')['ar'] : '-'}}</p>

                            <p class="card-text"><span> @lang('admin.price')  :- </span> {{$food->price}}</p>
                            <p class="card-text"><span> @lang('admin.qty')  :- </span>{{$food->qty}}</p>
                            <p class="card-text"><span> @lang('admin.numberOfCalories')  :- </span>{{$food->numberOfCalories}}</p>
                            <p class="card-text"><span> @lang('admin.fat_percentage')  :- </span>{{$food->fat_percentage}}</p>
                            <p class="card-text"><span> @lang('admin.carbohydrate_percentage')  :- </span>{{$food->carbohydrate_percentage}}</p>
                            <p class="card-text"><span> @lang('admin.protein_percentage')  :- </span>{{$food->protein_percentage}}</p>

                           <a href="{{route('foods.edit',$food->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
