<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\DataTables\TypeDataTable;
use App\Http\Requests\CreateTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Repositories\TypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TypeController extends AppBaseController
{
    /** @var TypeRepository $typeRepository*/
    private $typeRepository;

    public function __construct(TypeRepository $typeRepo)
    {
        $this->typeRepository = $typeRepo;
        $this->middleware('permission:type-list|type-create|type-edit|type-delete', ['only' => ['index','show']]);
        $this->middleware('permission:type-create', ['only' => ['create','store']]);
        $this->middleware('permission:type-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:type-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the Type.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(TypeDataTable $dataTable)
    {
        return $dataTable->render('admin.types.index');
    }


    /**
     * Show the form for creating a new Type.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created Type in storage.
     *
     * @param CreateTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateTypeRequest $request)
    {
        $input = $request->all();

        $type = $this->typeRepository->create($input);

        $messages = ['success' => "Successfully added", 'redirect' => route('types.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified Type.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $type = $this->typeRepository->find($id);

        if (empty($type)) {
            Flash::error('Type not found');

            return redirect(route('types.index'));
        }

        return view('admin.types.show')->with('type', $type);
    }

    /**
     * Show the form for editing the specified Type.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $type = $this->typeRepository->find($id);

        if (empty($type)) {
            Flash::error('Type not found');

            return redirect(route('types.index'));
        }

        return view('admin.types.edit')->with('type', $type);
    }

    /**
     * Update the specified Type in storage.
     *
     * @param int $id
     * @param UpdateTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTypeRequest $request)
    {
        $type = $this->typeRepository->find($id);

        if (empty($type)) {
            Flash::error('Type not found');

            return redirect(route('types.index'));
        }
        $input = $request->all();

        $type = $this->typeRepository->update($input, $id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('types.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified Type from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $type = $this->typeRepository->find($id);

        if (empty($type)) {
            Flash::error('Type not found');

            return redirect(route('types.index'));
        }

        $this->typeRepository->delete($id);

        $messages = ['success' => "Successfully deletd", 'redirect' => route('types.index')];
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

        $this->typeRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deltetd", 'redirect' => route('types.index')];
        return response()->json(['messages' => $messages]);
    }
}
