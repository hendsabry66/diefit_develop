@extends('web.layouts.master')
@section('title')
    |
    @lang('web.articles')
@endsection
@section('content')
    <div class="intro article">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="content">
                        <h1>{{$slider->title}}</h1>
                        <p>{!! $slider->description !!} </p>
                        <a href="{{$slider->link_btn}}" class="btn btn-success">{{$slider->btn_name}}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <figure>
                        <img src="{{$slider->image}}" alt="">
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <div class="blog article">
        <div class="container">
            <div class="head">
                <h2> @lang('web.New articles')</h2>
            </div>
            <div class="row">
                @foreach ($articles as $article)
                    <div class="col-md-4 col-6">
                        <div class="item card-sile mb-5">
                            <a href="{{ LaravelLocalization::localizeUrl('article/' . $article->id) }}">
                                <figure><img src="{{ $article->image }}" alt=""></figure>
                                <h3>{{ $article->title }} </h3>
                            </a>
                            <div class="caption">
                                <div class="d-none d-md-block">
                                    <div class="description">
                                        {!! strip_tags($article->short_description) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="" class="btn share" style="border: 0"></a>
                                <form method="post" action="{{ url('addFavorite') }}" id="favouritePost">
                                    @csrf
                                    <input type="hidden" name="article_id" value="{{ $article->id }}" id="article_id">
                                    <button type="submit" class="btn favorite" style="border: 0"></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#favouritePost").submit(function(e) {
                e.preventDefault();

                var article_id = $("#article_id").val();
                $.ajax({
                    method: "post",
                    url: "{{ url('addFavorite') }}",
                    dataType: "json",
                    data: {
                        article_id: article_id
                    },
                    cache: false,
                    success: function(response) {

                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection
