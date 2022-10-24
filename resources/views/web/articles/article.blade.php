@extends('web.layouts.master')
@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{LaravelLocalization::localizeUrl('/')}}">@lang('web.home')</a></li>
                <li class="breadcrumb-item"><a href="{{LaravelLocalization::localizeUrl('/articles/'.$article->articleCategory->id)}}">@lang('web.articles')</a></li>
                <li class="breadcrumb-item active" aria-current="page"> {{$article->title}}</li>
            </ol>
        </nav>
    </div>


    <div class="article-single">
        <div class="container">
            <div class="entry-content">
                <div class="head">
                    <h2>{{$article->title}}</h2>
                </div>
                <figure class="text-center">
                    <img src="{{$article->image}}" alt="">
                </figure>
                <p><span class="mb-4 date"><i class="fa-solid fa-clock"></i> {{$article->created_at}}</span></p>
                <p>{!! $article->short_description !!}</p>
                <div class="editor">
                    <div class="d-md-flex align-items-md-center text-center text-md-start">
                        @if(!empty($article->user->image))
                            <figure class="mb-3 mb-md-0"><img src="{{$article->user->image}}" alt=""></figure>
                        @else
                            <figure class="mb-3 mb-md-0"><img src="{{asset('web/assets/images/user01.png')}}" alt=""></figure>
                        @endif

                        <div class="caption">
                            <p><small>@lang('web.publisher')</small></p>
                            <h3><strong> {{$article->user->name}}</strong></h3>
                            <p class="mb-0"> {!! $article->details !!}</p>
                        </div>
                    </div>
                </div>



                <button class="btn btn-warning" onclick="window.print()"><i class="fa-solid fa-file-pdf"></i> @lang('web.print article')</button>
            </div>
            <hr class="mt-5 mb-5">
            <div class="comments">
                <div  id="comment_block">
                    <div class="head">
                        <h2>@lang('web.comments') ({{(!empty($article->articleComments))? count($article->articleComments) : 0 }})</h2>
                    </div>
                    <div class="items">
                        @if(!empty( $article->articleComments ))
                        @foreach($article->articleComments as $comment)
                            <div class="item">
                                <div class="d-md-flex text-center text-md-start">
                                    @if(!empty($comment->user->image))
                                        <figure><img src="{{$comment->user->image}}" alt=""></figure>
                                    @else
                                        <figure><img src="{{asset('web/assets/images/user01.png')}}" alt=""></figure>
                                    @endif

                                    <div class="caption">
                                        <h2>{{$comment->user->name}} </h2>
                                        {{--                                    <p class="mb-2"><small>طالب</small></p>--}}
                                        <p class="mb-0">{{$comment->body}}   </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                            @endif
                    </div>
                </div>

                <div class="form">
                    <div class="head">
                        <h2>@lang('web.add comment')</h2>
                    </div>
                    <form action="" method="post" id="commentPost">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control" placeholder="" value="{{$article->id}}" name="article_id" id="article_id">
                        </div>
                        <div class="mb-3">
                            <textarea style="min-height:100px" class="form-control"
                                placeholder=" " name="body" id="body"></textarea>
                        </div>
                        <div class="float-end">
                            <input class="btn btn-success" type="submit" value="{{__('web.send')}}">
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
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
            $("#commentPost").submit(function (e) {
                 e.preventDefault();

            var body = $("#body").val();
            var article_id = $("#article_id").val();
            $.ajax({
                method: "post",
                url: "{{ route('comments.store') }}",
                dataType: "html",
                data: {body: body, article_id: article_id},
                cache: false,
                success: function (response) {

                    $("#comment_block").html(response);
                    $("#body").val('');
                }
            });
        });
        });
    </script>
@endsection
