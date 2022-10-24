<?php

namespace App\Http\Controllers\Admin\Food;

use App\DataTables\FoodDataTable;
use App\Http\Requests\CreateFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\FoodImage;
use App\Repositories\FoodRepository;
use App\Repositories\ExtraRepository;
use App\Repositories\FoodCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Image;

class FoodController extends AppBaseController
{
    /** @var FoodRepository $foodRepository*/
    private $foodRepository , $foodCategoryRepository , $extraRepository;

    public function __construct(FoodRepository $foodRepo , FoodCategoryRepository $foodCategoryRepo , ExtraRepository $extraRepo)
    {
        $this->foodRepository = $foodRepo;
        $this->foodCategoryRepository = $foodCategoryRepo;
        $this->extraRepository = $extraRepo;
    }


    /**
     * Display a listing of the Food.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(FoodDataTable $dataTable)
    {
        return $dataTable->render('admin.foods.index');
    }

    /**
     * Show the form for creating a new Food.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->foodCategoryRepository->all();
        $extras = $this->extraRepository->all();
        return view('admin.foods.create', compact('categories' , 'extras'));
    }

    /**
     * Store a newly created Food in storage.
     *
     * @param CreateFoodRequest $request
     *
     * @return Response
     */
    public function store(CreateFoodRequest $request)
    {
        $input = $request->all();
        $food = $this->foodRepository->createFood($input);
        if(!empty($input['extras'])){
            $food->extras()->sync($input['extras']);
        }
        $images = $request->file('images');

        if(!empty($images)){

            foreach ($images as $image){
                $img = Image::make($image);
                $imgPath = 'uploads/food/';
                $imgName =time().$image->getClientOriginalName();
                $img =  $img->save($imgPath.$imgName);
                $foodimage = FoodImage::create([
                    'image' =>$imgName,
                    'food_id' =>$food->id,
                ]);
            }
        }

        $messages = ['success' => "Successfully added", 'redirect' => route('foods.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified Food.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $food = $this->foodRepository->find($id);

        if (empty($food)) {
            $messages = ['success' => "Food not found", 'redirect' => route('foods.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.foods.show', compact('food'));
    }

    /**
     * Show the form for editing the specified Food.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $food = $this->foodRepository->find($id);

        if (empty($food)) {
            $messages = ['success' => "Food not found", 'redirect' => route('foods.index')];
            return response()->json(['messages' => $messages]);
        }
        $extras = $this->extraRepository->all();

        $categories = $this->foodCategoryRepository->all();

        return view('admin.foods.edit', compact('food' , 'categories' , 'extras'));
    }

    /**
     * Update the specified Food in storage.
     *
     * @param int $id
     * @param UpdateFoodRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFoodRequest $request)
    {
        $food = $this->foodRepository->find($id);

        if (empty($food)) {
            $messages = ['success' => "Food not found", 'redirect' => route('foods.index')];
            return response()->json(['messages' => $messages]);
        }

        $input = $request->all();
        $food = $this->foodRepository->updateFood($input, $id);
        if(!empty($input['extras'])){
            $food->extras()->sync($input['extras']);
        }
        $images = $request->file('images');
        if(!empty($images)){

            foreach ($images as $image){
                $img = Image::make($image);
                $imgPath = 'uploads/food/';
                $imgName =time().$image->getClientOriginalName();
                $img =  $img->save($imgPath.$imgName);
                $food->images()->create([
                    'image' =>$imgName,
                ]);
            }
        }

        $messages = ['success' => "Successfully updated", 'redirect' => route('foods.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified Food from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $food = $this->foodRepository->find($id);

        if (empty($food)) {
            $messages = ['success' => "Food not found", 'redirect' => route('foods.index')];
            return response()->json(['messages' => $messages]);
        }

        $this->foodRepository->delete($id);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('foods.index')];
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

        $this->foodRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('foods.index')];
        return response()->json(['messages' => $messages]);
    }

}
