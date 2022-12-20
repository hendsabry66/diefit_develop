<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AreaDataTable;
use App\Http\Requests\CreateAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Repositories\AreaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AreaController extends AppBaseController
{
    /** @var AreaRepository $areaRepository*/
    private $areaRepository;

    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
        $this->middleware('permission:area-list|area-create|area-edit|area-delete', ['only' => ['index','show']]);
        $this->middleware('permission:area-create', ['only' => ['create','store']]);
        $this->middleware('permission:area-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:area-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Area.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(AreaDataTable $dataTable)
    {
        return $dataTable->render('admin.areas.index');
    }

    /**
     * Show the form for creating a new Area.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.areas.create');
    }

    /**
     * Store a newly created Area in storage.
     *
     * @param CreateAreaRequest $request
     *
     * @return Response
     */
    public function store(CreateAreaRequest $request)
    {
        $input = $request->all();


        $area = $this->areaRepository->create([
            'name' =>[
                'en' => $input['name_en'],
                'ar' => $input['name_ar'],
            ],
            'status' => $input['status'],
        ]);
        $messages = ['success' => "Successfully added", 'redirect' => route('areas.index')];
        return response()->json(['messages' => $messages]);


    }

    /**
     * Display the specified Area.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            Flash::error('Area not found');

            return redirect(route('areas.index'));
        }

        return view('admin.areas.show')->with('area', $area);
    }

    /**
     * Show the form for editing the specified Area.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            Flash::error('Area not found');

            return redirect(route('areas.index'));
        }

        return view('admin.areas.edit')->with('area', $area);
    }

    /**
     * Update the specified Area in storage.
     *
     * @param int $id
     * @param UpdateAreaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAreaRequest $request)
    {
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            Flash::error('Area not found');

            return redirect(route('areas.index'));
        }
        $input = $request->all();
        $area = $this->areaRepository->update(['name' =>[
                    'en' => $input['name_en'],
                    'ar' => $input['name_ar'],
                ],
            'status' => $input['status']], $id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('areas.index')];
        return response()->json(['messages' => $messages]);

    }

    /**
     * Remove the specified Area from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $area = $this->areaRepository->find($id);

        if (empty($area)) {
            $messages = ['danger' => "Area not found", 'redirect' => route('areas.index')];
            return response()->json(['messages' => $messages]);
        }
        $this->areaRepository->deleteRelatedCities($area);
        $this->areaRepository->delete($id);
        $messages = ['success' => "Successfully deletd", 'redirect' => route('areas.index')];
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

        $this->areaRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deltetd", 'redirect' => route('areas.index')];
        return response()->json(['messages' => $messages]);
    }
}
