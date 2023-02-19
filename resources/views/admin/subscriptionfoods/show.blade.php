@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.subscriptions')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('subscriptions.index')}}"> @lang('admin.subscriptions')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.addSubscription')
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
                <div class="card" >
                    <div class="card-content">
                        <div class="card-body">
                            @if(!empty($subscription->image))
                                <img class=" img-fluid mb-1" width="100" src="{{$subscription->image}}" alt="Card image cap">
                            @endif
                            <h4 class="card-title"># {{$subscription->id}} </h4>
                            <p><span>@lang('admin.name') :- </span> {{ $subscription->getTranslations('name')['ar'] }} - {{ $subscription->getTranslations('name')['en'] }}</p>
                            <p class="card-text"><span>@lang('admin.details_ar')</span>{!!  $subscription->getTranslations('details')['ar'] !!}</p>
                            <p class="card-text"><span>@lang('admin.details_en')</span>{!!  $subscription->getTranslations('details')['en'] !!}</p>
                            @if($subscription->has_specialist == 1)
                                <p class="card-text"><span>@lang('admin.specialist_price_for_session')</span>
                                    {{$subscription->specialist_price_for_session}}
                                </p>
                                <p class="card-text"><span>@lang('admin.suggested_session_number')</span>
                                    {{$subscription->suggested_session_number}}
                                </p>
                            @endif
                            @if($subscription->has_calories ==1)
                                <p class="card-text"><span>@lang('admin.calories')</span>
                                    @foreach(json_decode($subscription->calories) as $calorie)

                                        {{$calorie}} -

                                    @endforeach
                                </p>
                            @endif
                            <p class="card-text"><span>عدد ايام التوصيل للمطبخ</span>
                                {{$subscription->number_of_delivery_days}}
                            </p>
                            <p class="card-text"><span>مدة الاشتراك للعميل </span>
                                {{$subscription->period}}
                            </p>
                            <p class="card-text"><span>@lang('admin.price') </span>
                                {{$subscription->price}}
                            </p>
                            @if($subscription->has_meals == 1)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>الوجبة</th>
                                        <th colspan="4">التفاصيل</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subscription->subscriptionFoods as $value)
                                        <tr>
                                            <td>{{$value->food->name}}</td>
                                            @foreach(\App\Models\SubsrcriptionFoodIngredient::where('subscription_food_id',$value->id)->get() as $ingredient)


                                                <td>{{$ingredient->ingredient}}</td>
                                                <td>{{$ingredient->qty}}</td>

                                            @endforeach

                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>



                            @endif
                            <a href="{{route('subscriptions.edit',$subscription->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

@endsection
