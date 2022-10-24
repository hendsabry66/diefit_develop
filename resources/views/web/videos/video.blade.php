@extends('web.layouts.master')
@section('title', 'Videos')
@section('content')


    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">@lang('web.home')</a></li>
                <li class="breadcrumb-item"><a href="{{url('videos')}}">@lang('web.videos')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$video->title}}</li>
            </ol>
        </nav>
    </div>


    <div class="video-single">
        <div class="container">
            <div class="entry-content">
                <div class="head">
                    <h2>  {{$video->title}}</h2>
                </div>
                <figure class="text-center main-img">
{{--                    <img src="assets/images/a1.jpg" alt="">--}}
{{--                    <a href="https://www.youtube.com/watch?v=lkdMvk3CHro" data-fancybox><i--}}
{{--                            class="fa-solid fa-circle-play"></i></a>--}}
                    <video width="320" height="240" controls>
                        <source src="{{$video->video}}" type="video/mp4">
                    </video>
                </figure>
                <p><span class="mb-4 date"><i class="fa-solid fa-clock"></i> {{$video->created_at}}</span></p>
                <p>{!! $video->details !!}</p>
            </div>
            <hr class="mt-5 mb-5">
            <div class="comments">
                <div  id="comment_block">
                    <div class="head">
                        <h2>@lang('web.comments') ({{(!empty($video->videoComments))? count($video->videoComments) : 0 }})</h2>
                    </div>
                    <div class="items">
                        @if(!empty( $video->videoComments ))

                        @foreach($video->videoComments as $comment)
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
                            <input type="hidden" class="form-control" placeholder="" value="{{$video->id}}" name="video_id" id="video_id">
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
                var video_id = $("#video_id").val();
                $.ajax({
                    method: "post",
                    url: "{{ route('videocomments.store') }}",
                    dataType: "html",
                    data: {body: body, video_id: video_id},
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
