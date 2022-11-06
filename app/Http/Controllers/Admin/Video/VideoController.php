<?php

namespace App\Http\Controllers\Admin\video;

use App\DataTables\VideoDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use App\Repositories\UserRepository;
use App\Repositories\VideoRepository;
use App\Repositories\VideoCategoryRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class VideoController extends AppBaseController
{
    /** @var VideoRepository $videoRepository*/
    private $videoRepository;
    private $videoCategoryRepository;

    public function __construct(VideoRepository $videoRepo , VideoCategoryRepository $videoCategoryRepo ,UserRepository $userRepo)
    {
        $this->videoCategoryRepository = $videoCategoryRepo;
        $this->videoRepository = $videoRepo;
        $this->userRepository = $userRepo;
//        $this->middleware('permission:video-list|video-create|video-edit|video-delete', ['only' => ['index','show']]);
//        $this->middleware('permission:video-create', ['only' => ['create','store']]);
//        $this->middleware('permission:video-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:video-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the video.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(VideoDataTable $dataTable)
    {
        return $dataTable->render('admin.videos.index');
    }

    /**
     * Show the form for creating a new Video.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->videoCategoryRepository->all();
        $users = $this->userRepository->all();
        return view('admin.videos.create')->with('categories',$categories)->with('users',$users);
    }

    /**
     * Store a newly created Video in storage.
     *
     * @param CreateVideoRequest $request
     *
     * @return Response
     */
    public function store(CreateVideoRequest $request)
    {
        $input = array_except($request->all(),['video']);
        if(!empty($request->has('video'))){
            $video = $request->file('video');
            $videoname = time().$video->getClientOriginalName();
            $videoPath = 'uploads/video/';
            $video->move($videoPath, $videoname);
            $input['video']=$videoname;
        }

        $video = $this->videoRepository->create([
            'title' =>[
                'en' => $input['title_en'],
                'ar' => $input['title_ar'],
            ],
            'short_description' =>[
                'en' => $input['short_description_en'],
                'ar' => $input['short_description_ar'],
            ],
            'details' =>[
                'en' => $input['details_en'],
                'ar' => $input['details_ar'],
            ],
            'status' => $input['status'],
            'video_category_id' => $input['video_category_id'],
            'video' => $input['video'],
            'user_id' => auth()->user()->id,
        ]);

        $messages = ['success' => "Successfully added", 'redirect' => route('videos.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified Video.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $video = $this->videoRepository->find($id);

        if (empty($video)) {
            Flash::error('video not found');

            return redirect(route('videos.index'));
        }

        return view('admin.videos.show')->with('video', $video);
    }

    /**
     * Show the form for editing the specified video.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $video = $this->videoRepository->find($id);

        if (empty($video)) {
            Flash::error('video not found');

            return redirect(route('videos.index'));
        }
        $categories = $this->videoCategoryRepository->all();
        $users = $this->userRepository->all();

        return view('admin.videos.edit')->with('video', $video)->with('categories',$categories)->with('users',$users);
    }

    /**
     * Update the specified video in storage.
     *
     * @param int $id
     * @param UpdatevideoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVideoRequest $request)
    {
        $video = $this->videoRepository->find($id);

        if (empty($video)) {
            Flash::error('video not found');

            return redirect(route('videos.index'));
        }
        $input = array_except($request->all(),['image']);
        if(!empty($request->has('video'))){
            $video = $request->file('video');
            $videoname = time().$video->getClientOriginalName();
            $videoPath = 'uploads/video/';
            $video->move($videoPath, $videoname);
            $video->video=$videoname;
        }

        $video = $this->videoRepository->update([
            'title' =>[
                'en' => $input['title_en'],
                'ar' => $input['title_ar'],
            ],
            'short_description' =>[
                'en' => $input['short_description_en'],
                'ar' => $input['short_description_ar'],
            ],
            'details' =>[
                'en' => $input['details_en'],
                'ar' => $input['details_ar'],
            ],
            'status' => $input['status'],
            'video_category_id' => $input['video_category_id'],

            'user_id' => $input['user_id'],
        ], $id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('videos.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified video from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $video = $this->videoRepository->find($id);

        if (empty($video)) {
            Flash::error('video not found');

            return redirect(route('videos.index'));
        }

        $this->videoRepository->delete($id);
        $messages = ['success' => "Successfully deleted", 'redirect' => route('videos.index')];
        return response()->json(['messages' => $messages]);

    }

    /**
     * Bulk delete
     * @param Request $request
     *
     * @return \Illuminate\Support\Facades\Redirect
     *
     * @throws \Exception
     */
    public function bulkDelete(Request $request) {
        if (! $request->ids) {
            flash('قبل التأكيد على الاختيار المتعدد . من فضلك اختر من القائمة اولا')->error();
            return redirect()->back();
        }

        $this->videoRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('videos.index')];
        return response()->json(['messages' => $messages]);
    }

}
