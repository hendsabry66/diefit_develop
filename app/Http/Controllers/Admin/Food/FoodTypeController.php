<?php

namespace App\Http\Controllers\Admin\Food;

use App\DataTables\FoodTypeDataTable;
use App\Http\Requests\CreateFoodTypeRequest;
use App\Http\Requests\UpdateFoodTypeRequest;
use App\Repositories\FoodTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FoodTypeController extends AppBaseController
{
    /** @var FoodTypeRepository $foodTypeRepository*/
    private $foodTypeRepository;

    public function __construct(FoodTypeRepository $foodTypeRepo)
    {
        $this->foodTypeRepository = $foodTypeRepo;
    }

    /**
     * Display a listing of the FoodType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(FoodTypeDataTable $dataTable)
    {
        return $dataTable->render('admin.foodTypes.index');
    }


    /**
     * Show the form for creating a new FoodType.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.foodTypes.create');
    }

    /**
     * Store a newly created FoodType in storage.
     *
     * @param CreateFoodTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateFoodTypeRequest $request)
    {
        $input = $request->all();

        $foodType = $this->foodTypeRepository->createFoodType($input);
        $messages = ['success' => "Successfully added", 'redirect' => route('foodTypes.index')];
        return response()->json(['messages' => $messages]);


    }

    /**
     * Display the specified FoodType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $foodType = $this->foodTypeRepository->find($id);

        if (empty($foodType)) {
            $messages = ['success' => "Food Type not found", 'redirect' => route('foodTypes.index')];
            return response()->json(['messages' => $messages]);
        }

        return view('admin.foodTypes.show', compact('foodType'));
    }

    /**
     * Show the form for editing the specified FoodType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $foodType = $this->foodTypeRepository->find($id);

        if (empty($foodType)) {
            $messages = ['success' => "Food Type not found", 'redirect' => route('foodTypes.index')];
            return response()->json(['messages' => $messages]);
        }

        return view('admin.foodTypes.edit', compact('foodType'));
    }

    /**
     * Update the specified FoodType in storage.
     *
     * @param int $id
     * @param UpdateFoodTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFoodTypeRequest $request)
    {
        $foodType = $this->foodTypeRepository->find($id);

        if (empty($foodType)) {
            $messages = ['success' => "Food Type not found", 'redirect' => route('foodTypes.index')];
            return response()->json(['messages' => $messages]);
        }

        $input = $request->all();
        $foodType = $this->foodTypeRepository->updateFoodType($input, $id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('foodTypes.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified FoodType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $foodType = $this->foodTypeRepository->find($id);

        if (empty($foodType)) {
            $messages = ['success' => "Food Type not found", 'redirect' => route('foodTypes.index')];
            return response()->json(['messages' => $messages]);
        }

        $this->foodTypeRepository->delete($id);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('foodTypes.index')];
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
