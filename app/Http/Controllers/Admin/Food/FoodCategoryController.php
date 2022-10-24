<?php

namespace App\Http\Controllers\Admin\Food;

use App\DataTables\FoodCategoryDataTable;
use App\Http\Requests\CreateFoodCategoryRequest;
use App\Http\Requests\UpdateFoodCategoryRequest;
use App\Repositories\FoodCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FoodCategoryController extends AppBaseController
{
    /** @var FoodCategoryRepository $foodCategoryRepository*/
    private $foodCategoryRepository;

    public function __construct(FoodCategoryRepository $foodCategoryRepo)
    {
        $this->foodCategoryRepository = $foodCategoryRepo;
//        $this->middleware('permission:food-category-list|food-category-create|food-category-edit|food-category-delete', ['only' => ['index','show']]);
//        $this->middleware('permission:food-category-create', ['only' => ['create','store']]);
//        $this->middleware('permission:food-category-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:food-category-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the FoodCategory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(FoodCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.food_categories.index');
    }


    /**
     * Show the form for creating a new FoodCategory.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->foodCategoryRepository->all();
        return view('admin.food_categories.create', compact('categories'));
    }

    /**
     * Store a newly created FoodCategory in storage.
     *
     * @param CreateFoodCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateFoodCategoryRequest $request)
    {
        $foodCategory = $this->foodCategoryRepository->createCategory($request->all());
        $messages = ['success' => "Successfully added", 'redirect' => route('foodCategories.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified FoodCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $foodCategory = $this->foodCategoryRepository->find($id);

        if (empty($foodCategory )) {
            $messages = ['success' => "Food Category not found", 'redirect' => route('foodCategories.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.food_categories.show', compact('foodCategory'));
    }

    /**
     * Show the form for editing the specified FoodCategory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $foodCategory = $this->foodCategoryRepository->find($id);
        $categories = $this->foodCategoryRepository->all();

        if (empty($foodCategory)) {
            $messages = ['success' => "Food Category not found", 'redirect' => route('foodCategories.index')];
            return response()->json(['messages' => $messages]);
        }

        return view('admin.food_categories.edit', compact('foodCategory', 'categories'));
    }

    /**
     * Update the specified FoodCategory in storage.
     *
     * @param int $id
     * @param UpdateFoodCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFoodCategoryRequest $request)
    {
        $foodCategory = $this->foodCategoryRepository->find($id);

        if (empty($foodCategory)) {
            $messages = ['success' => "Food Category not found", 'redirect' => route('foodCategories.index')];
            return response()->json(['messages' => $messages]);
        }
        $foodCategory = $this->foodCategoryRepository->updateCategory($request->all(), $id);
        $messages = ['success' => "Successfully updated", 'redirect' => route('foodCategories.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified FoodCategory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $foodCategory = $this->foodCategoryRepository->find($id);

        if (empty($foodCategory)) {
            $messages = ['success' => "Food Category not found", 'redirect' => route('foodCategories.index')];
            return response()->json(['messages' => $messages]);
        }

        $this->foodCategoryRepository->delete($id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('foodCategories.index')];
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

        $this->foodCategoryRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('foodCategories.index')];
        return response()->json(['messages' => $messages]);
    }

}
