<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\DataTables\CityDataTable;
use App\Models\Area;
use App\Repositories\CityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CityController extends AppBaseController
{
    /** @var CityRepository $cityRepository*/
    private $cityRepository;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo;
//        $this->middleware('permission:city-list|city-create|city-edit|city-delete', ['only' => ['index','show']]);
//        $this->middleware('permission:city-create', ['only' => ['create','store']]);
//        $this->middleware('permission:city-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:city-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the City.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(CityDatatable $dataTable)
    {

        return $dataTable->render('admin.cities.index');
    }

    /**
     * Show the form for creating a new City.
     *
     * @return Response
     */
    public function create()
    {
        $areas = Area::get();
        return view('admin.cities.create',compact('areas'));
    }

    /**
     * Store a newly created City in storage.
     *
     * @param CreateCityRequest $request
     *
     * @return Response
     */
    public function store(CreateCityRequest $request)
    {
        $input = $request->all();

        $city = $this->cityRepository->create([
            'name' =>[
                'en' => $input['name_en'],
                'ar' => $input['name_ar'],
            ],
            'area_id' => $input['area_id'],
            'status' => $input['status'],
            'delivery_cost' => $input['delivery_cost'],
        ]);

        $messages = ['success' => "Successfully added", 'redirect' => route('cities.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified City.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('cities.index'));
        }

        return view('admin.cities.show')->with('city', $city);
    }

    /**
     * Show the form for editing the specified City.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $city = $this->cityRepository->find($id);
        $areas = Area::get();
        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('cities.index'));
        }

        return view('admin.cities.edit')->with('city', $city)->with('areas',$areas);
    }

    /**
     * Update the specified City in storage.
     *
     * @param int $id
     * @param UpdateCityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCityRequest $request)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('cities.index'));
        }
        $input = $request->all();
        $city = $this->cityRepository->update([
            'name' =>[
                'en' => $input['name_en'],
                'ar' => $input['name_ar'],
            ],
            'area_id' => $input['area_id'],
            'status' => $input['status'],
            'delivery_cost' => $input['delivery_cost'],
        ], $id);
        $messages = ['success' => "Successfully updated", 'redirect' => route('cities.index')];
        return response()->json(['messages' => $messages]);

    }

    /**
     * Remove the specified City from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('City not found');

            return redirect(route('cities.index'));
        }

        $this->cityRepository->delete($id);

        $messages = ['success' => "Successfully deltetd", 'redirect' => route('cities.index')];
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

        $this->cityRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deltetd", 'redirect' => route('cities.index')];
        return response()->json(['messages' => $messages]);
    }

    public function cityAjax($area_id){

         $cities = $this->cityRepository->allQuery(['area_id'=>$area_id])->get();
        return response()->json($cities);
    }
}
