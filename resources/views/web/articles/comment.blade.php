<div class="head">
    <h2>@lang('web.comments') ({{count($article->articleComments)}})</h2>
</div>
<div class="items">
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
</div>

