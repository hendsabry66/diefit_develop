<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Repositories\StatusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\DataTables\StatusDataTable;
use Flash;
use Response;

class StatusController extends AppBaseController
{
    /** @var StatusRepository $statusRepository*/
    private $statusRepository;

    public function __construct(StatusRepository $statusRepo)
    {
        $this->statusRepository = $statusRepo;
        $this->middleware('permission:status-list|status-create|status-edit|status-delete', ['only' => ['index','show']]);
        $this->middleware('permission:status-create', ['only' => ['create','store']]);
        $this->middleware('permission:status-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:status-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the StatusController.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index( StatusDatatable $datatable)
    {
        return $datatable->render('admin.status.index');
    }

    /**
     * Show the form for creating a new StatusController.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.status.create');
    }

    /**
     * Store a newly created StatusController in storage.
     *
     * @param CreateStatusControllerRequest $request
     *
     * @return Response
     */
    public function store(CreateStatusRequest $request)
    {
        $input = $request->all();

        $status = $this->statusRepository->create([
            'name' =>[
                'en' => $input['name_en'],
                'ar' => $input['name_ar'],
            ]
        ]);
        $messages = ['success' => "Successfully added", 'redirect' => route('status.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified StatusController.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $status = $this->statusRepository->find($id);

        if (empty($status)) {
            $messages = ['success' => "Status Controller not found", 'redirect' => route('status.index')];
            return response()->json(['messages' => $messages]);
        }

        return view('status_controllers.show',compact('status'));
    }

    /**
     * Show the form for editing the specified StatusController.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $status = $this->statusRepository->find($id);

        if (empty($status)) {
            $messages = ['success' => "Status Controller not found", 'redirect' => route('status.index')];
            return response()->json(['messages' => $messages]);
        }

        return view('admin.status.edit',compact('status'));
    }

    /**
     * Update the specified StatusController in storage.
     *
     * @param int $id
     * @param UpdateStatusControllerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStatusRequest $request)
    {
        $status = $this->statusRepository->find($id);

        if (empty($status)) {
            $messages = ['success' => "Status Controller not found", 'redirect' => route('status.index')];
            return response()->json(['messages' => $messages]);
        }

        $input = $request->all();
        $status = $this->statusRepository->update([
            'name'=>[
                'en'=>$input['name_en'],
                'ar'=>$input['name_ar'],
            ]
        ], $id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('status.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified StatusController from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $status = $this->statusRepository->find($id);

        if (empty($statusController)) {
            $messages = ['success' => "Status Controller not found", 'redirect' => route('status.index')];
            return response()->json(['messages' => $messages]);
        }

        $this->statusRepository->delete($id);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('status.index')];
        return response()->json(['messages' => $messages]);

    }
}
