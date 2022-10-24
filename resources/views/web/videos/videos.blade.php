@extends('web.layouts.master')
@section('title', 'Videos')
@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">@lang('web.home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('web.videos')</li>
            </ol>
        </nav>
    </div>

    <div class="blog video">
        <div class="container">
            <div class="head text-center mb-5">
                <h2>@lang('web.videos')</h2>
            </div>
            <div class="row">

                @foreach($videos as $video)

                    <div class="col-md-4 col-6">
                        <div class="item card-sile mb-5">
                            <a href="{{url('video/'.$video->id)}}">
{{--                                <figure><img src="{{$video->$video}}" alt=""></figure>--}}
                                <video width="320" height="240" controls>
                                    <source src="{{$video->video}}" type="video/mp4">
                                </video>
                                <h3>{{$video->title}} </h3>
                            </a>
                            <p class="d-none d-md-block">{!! strip_tags($video->short_description) !!} </p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection
