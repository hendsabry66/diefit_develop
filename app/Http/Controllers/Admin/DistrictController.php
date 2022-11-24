<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Repositories\DistrictRepository;
use App\Http\Controllers\AppBaseController;
use App\DataTables\DistrictsDataTable;
use Illuminate\Http\Request;
use App\Models\City;
use Flash;
use Response;

class DistrictController extends AppBaseController
{
    /** @var DistrictRepository $districtRepository*/
    private $districtRepository;

    public function __construct(DistrictRepository $districtRepo)
    {
        $this->districtRepository = $districtRepo;
    }

    /**
     * Display a listing of the District.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(DistrictsDataTable $dataTable){
        return $dataTable->render('admin.districts.index');
    }


    /**
     * Show the form for creating a new District.
     *
     * @return Response
     */
    public function create()
    {
        $cities = City::where('status','active')->get();
        return view('admin.districts.create',compact('cities'));
    }

    /**
     * Store a newly created District in storage.
     *
     * @param CreateDistrictRequest $request
     *
     * @return Response
     */
    public function store(CreateDistrictRequest $request)
    {
        $input = $request->all();

        $district = $this->districtRepository->create([
            'name' =>[
                'en' => $input['name_en'],
                'ar' => $input['name_ar'],
            ],
            'city_id' => $input['city_id'],
            'status' => $input['status'],
        ]);

        $messages = ['success' => "Successfully added", 'redirect' => route('districts.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified District.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $district = $this->districtRepository->find($id);

        if (empty($district)) {
            Flash::error('District not found');

            return redirect(route('districts.index'));
        }

        return view('admin.districts.show')->with('district', $district);
    }

    /**
     * Show the form for editing the specified District.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $district = $this->districtRepository->find($id);

        if (empty($district)) {
            Flash::error('District not found');

            return redirect(route('districts.index'));
        }
        $cities = City::where('status','active')->get();

        return view('admin.districts.edit',compact('district','cities'));
    }

    /**
     * Update the specified District in storage.
     *
     * @param int $id
     * @param UpdateDistrictRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDistrictRequest $request)
    {
        $district = $this->districtRepository->find($id);

        if (empty($district)) {
            Flash::error('district not found');

            return redirect(route('districts.index'));
        }
        $input = $request->all();
        $district = $this->districtRepository->update([
            'name' =>[
                'en' => $input['name_en'],
                'ar' => $input['name_ar'],
            ],
            'city_id' => $input['city_id'],
            'status' => $input['status'],
        ], $id);
        $messages = ['success' => "Successfully updated", 'redirect' => route('districts.index')];
        return response()->json(['messages' => $messages]);

    }

    /**
     * Remove the specified District from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $district = $this->districtRepository->find($id);

        if (empty($district)) {
            Flash::error('District not found');

            return redirect(route('districts.index'));
        }

        $this->districtRepository->delete($id);

        $messages = ['success' => "Successfully deltetd", 'redirect' => route('districts.index')];
        return response()->json(['messages' => $messages]);
    }
}
