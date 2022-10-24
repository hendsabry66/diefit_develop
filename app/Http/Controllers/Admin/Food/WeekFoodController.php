<?php

namespace App\Http\Controllers\Admin\Food;

use App\Http\Requests\CreateWeekFoodRequest;
use App\Http\Requests\UpdateWeekFoodRequest;
use App\Repositories\WeekFoodRepository;
use App\Repositories\FoodTypeRepository;
use App\Repositories\FoodRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class WeekFoodController extends AppBaseController
{
    /** @var WeekFoodRepository $weekFoodRepository*/
    private $weekFoodRepository , $foodTypeRepository , $foodRepository;

    public function __construct(WeekFoodRepository $weekFoodRepo , FoodTypeRepository $foodTypeRepo , FoodRepository $foodRepo)
    {
        $this->weekFoodRepository = $weekFoodRepo;
        $this->foodTypeRepository = $foodTypeRepo;
        $this->foodRepository = $foodRepo;
    }



    /**
     * Display a listing of the WeekFood.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $foodTypes = $this->foodTypeRepository->all();
        $foods = $this->foodRepository->all();

        return view('admin.weekFoods.index', compact('foodTypes' , 'foods'));
    }

    /**
     * Show the form for creating a new WeekFood.
     *
     * @return Response
     */
    public function create()
    {
        return view('week_foods.create');
    }

    /**
     * Store a newly created WeekFood in storage.
     *
     * @param CreateWeekFoodRequest $request
     *
     * @return Response
     */
    public function store(CreateWeekFoodRequest $request)
    {
          $input = $request->all();

        foreach ( $input['foodType_id'] as $key => $value) {
            foreach ( $input['foods'.$value] as $key2 => $value2) {
                $weekFood = $this->weekFoodRepository->create([
                    'food_type_id' => $value,
                    'food_id' => $value2,
                    'day' => $input['day'],
                ]);
            }
        }


        Flash::success('Week Food saved successfully.');

        return redirect(route('weekFoods.index'));
    }

    /**
     * Display the specified WeekFood.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $weekFood = $this->weekFoodRepository->find($id);

        if (empty($weekFood)) {
            Flash::error('Week Food not found');

            return redirect(route('weekFoods.index'));
        }

        return view('week_foods.show')->with('weekFood', $weekFood);
    }

    /**
     * Show the form for editing the specified WeekFood.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $weekFood = $this->weekFoodRepository->find($id);

        if (empty($weekFood)) {
            Flash::error('Week Food not found');

            return redirect(route('weekFoods.index'));
        }

        return view('week_foods.edit')->with('weekFood', $weekFood);
    }

    /**
     * Update the specified WeekFood in storage.
     *
     * @param int $id
     * @param UpdateWeekFoodRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWeekFoodRequest $request)
    {
        $weekFood = $this->weekFoodRepository->find($id);

        if (empty($weekFood)) {
            Flash::error('Week Food not found');

            return redirect(route('weekFoods.index'));
        }

        $weekFood = $this->weekFoodRepository->update($request->all(), $id);

        Flash::success('Week Food updated successfully.');

        return redirect(route('weekFoods.index'));
    }

    /**
     * Remove the specified WeekFood from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $weekFood = $this->weekFoodRepository->find($id);

        if (empty($weekFood)) {
            Flash::error('Week Food not found');

            return redirect(route('weekFoods.index'));
        }

        $this->weekFoodRepository->delete($id);

        Flash::success('Week Food deleted successfully.');

        return redirect(route('weekFoods.index'));
    }
}
