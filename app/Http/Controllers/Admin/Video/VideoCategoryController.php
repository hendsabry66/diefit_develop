<?php

namespace App\Http\Controllers\Admin\Video;

use App\DataTables\VideoCategoryDataTable;
use App\Http\Requests\CreateVideoCategoryRequest;
use App\Http\Requests\UpdateVideoCategoryRequest;
use App\Repositories\VideoCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class VideoCategoryController extends AppBaseController
{
    /** @var VideoCategoryRepository $videoCategoryRepository*/
    private $videoCategoryRepository;

    public function __construct(VideoCategoryRepository $videoCategoryRepo)
    {
        $this->videoCategoryRepository = $videoCategoryRepo;
        $this->middleware('permission:video-category-list|video-category-create|video-category-edit|video-category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:video-category-create', ['only' => ['create','store']]);
        $this->middleware('permission:video-category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:video-category-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the videoCategory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(VideoCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.video_categories.index');
    }


    /**
     * Show the form for creating a new videoCategory.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->videoCategoryRepository->all();
        return view('admin.video_categories.create')->with('categories',$categories);
    }

    /**
     * Store a newly created videoCategory in storage.
     *
     * @param CreatevideoCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateVideoCategoryRequest  $request)
    {
        $input = array_except($request->all(),['image']);

        $image = $request->file('image');

        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/video_category/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']=$imgName;
        }



        $videoCategory = $this->videoCategoryRepository->create([
            'name' =>[
                'en' => $input['name_en'],
                'ar' => $input['name_ar'],
            ],
            'status' => $input['status'],
            'parent_id' => $input['parent_id'],
            'image' => (isset($input['image'])?$input['image']:null),
        ]);
        $messages = ['success' => "Successfully added", 'redirect' => route('video_categories.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified videoCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $videoCategory = $this->videoCategoryRepository->find($id);

        if (empty($videoCategory)) {
            Flash::error('Video Category not found');

            return redirect(route('video_categories.index'));
        }

        return view('admin.video_categories.show')->with('videoCategory', $videoCategory);
    }

    /**
     * Show the form for editing the specified videoCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $videoCategory = $this->videoCategoryRepository->find($id);
        $categories = $this->videoCategoryRepository->all();

        if (empty($videoCategory)) {
            Flash::error('video Category not found');

            return redirect(route('video_categories.index'));
        }

        return view('admin.video_categories.edit')->with('videoCategory', $videoCategory)->with('categories',$categories);
    }

    /**
     * Update the specified videoCategory in storage.
     *
     * @param int $id
     * @param UpdateVideoCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVideoCategoryRequest $request)
    {
        $videoCategory = $this->videoCategoryRepository->find($id);

        if (empty($videoCategory)) {
            Flash::error('video Category not found');

            return redirect(route('video_categories.index'));
        }
        $input = array_except($request->all(),['image']);
        $image = $request->file('image');
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/video_category/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']= $imgName;
        }
        $videoCategory = $this->videoCategoryRepository->update([
            'name' =>[
                'en' => $input['name_en'],
                'ar' => $input['name_ar'],
            ],
            'status' => $input['status'],
            'parent_id' => $input['parent_id'],
            'image' => (isset($input['image'])?$input['image']:$videoCategory->image),
        ], $id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('video_categories.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified videoCategory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $videoCategory = $this->videoCategoryRepository->find($id);

        if (empty($videoCategory)) {
            Flash::error('video Category not found');

            return redirect(route('video_categories.index'));
        }

        $this->videoCategoryRepository->delete($id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('video_categories.index')];
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

        $this->videoCategoryRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('video_categories.index')];
        return response()->json(['messages' => $messages]);
    }

}
