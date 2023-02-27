@extends('web.layouts.master')
@section('title')
    |
    @lang('web.favourites')
@endsection
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">@lang('web.home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('web.favourites')</li>
            </ol>
        </nav>
    </div>

    <div class="products mt-5">
        <div class="container">
            <ul class="nav nav-tabs" id="favourite" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">الوجبات</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">المتجر</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <div class="row">
                        @foreach ($foods as $food)
                            <div class="col-md-4 col-6">
                                <div class="item card-sile favourite">
                                    <a href="" class="remove" data-title="ازالة من المفضلة"><i class="fa-solid fa-xmark"></i></a>
                                    <a href="{{ url('restaurant/foodDetails/' . $food->id) }}">
                                        <figure>
                                            @if ($food->image)
                                                <img src="{{ $food->image }}" alt="">
                                            @else
                                                <img src="{{ asset('web/assets/images/c01.png') }}" alt="">
                                            @endif
                                        </figure>
                                        <h3> {{ $food->name }}</h3>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <div class="row">
                        @foreach ($foods as $food)
                            <div class="col-md-4 col-6">
                                <div class="item card-sile favourite">
                                    <a href="" class="remove" data-title="ازالة من المفضلة"><i class="fa-solid fa-xmark"></i></a>
                                    <a href="{{ url('restaurant/foodDetails/' . $food->id) }}">
                                        <figure>
                                            @if ($food->image)
                                                <img src="{{ $food->image }}" alt="">
                                            @else
                                                <img src="{{ asset('web/assets/images/c01.png') }}" alt="">
                                            @endif
                                        </figure>
                                        <h3> {{ $food->name }}</h3>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
