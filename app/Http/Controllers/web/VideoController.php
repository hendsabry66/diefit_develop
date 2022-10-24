<?php
namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\VideoCategoryRepository;
use App\Repositories\VideoRepository;

class VideoController  extends Controller
{
    protected $videoCategoryRepository , $videoRepository;
    public function __construct( VideoCategoryRepository $videoCategoryRepository, VideoRepository $videoRepository)
    {
        $this->videoCategoryRepository = $videoCategoryRepository;
        $this->videoRepository = $videoRepository;
    }


    public function videos()
    {
        $videos = $this->videoRepository->all();
        return view('web.videos.videos')->with('videos', $videos);
    }


    public function video($id)
    {
        $video = $this->videoRepository->find($id);
        return view('web.videos.video')->with('video', $video);
    }

    public function videoCommentStore(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);
         $video = $this->videoRepository->find($request->video_id);
        $video->videoComments()->create([
            'body' => $request->body,
            'user_id' => auth()->user()->id,
        ]);
        return view('web.videos.comment',compact('video'));
    }
    public function videoAddFavorite(Request $request)
    {
        $video = $this->videoRepository->find($request->video_id);
        $video->favourites()->create([
            'user_id' => auth()->user()->id,
        ]);
        return response()->json(['success'=>'Added to favorite list']);
    }

}
