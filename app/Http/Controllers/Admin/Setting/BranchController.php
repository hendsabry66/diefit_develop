<?php

namespace App\Http\Controllers\Admin\Setting;

use App\DataTables\BranchDataTable;
use App\Http\Requests\CreateBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Repositories\BranchRepository;
use App\Repositories\CityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BranchController extends AppBaseController
{
    /** @var BranchRepository $branchRepository*/
    private $branchRepository;
    private $cityRepository;

    public function __construct(BranchRepository $branchRepo , CityRepository $cityRepo)
    {
        $this->branchRepository = $branchRepo;
        $this->cityRepository = $cityRepo;

        //$this->middleware('permission:branch-list|branch-create|branch-edit|branch-delete', ['only' => ['index','show']]);
//        $this->middleware('permission:branch-create', ['only' => ['create','store']]);
//        $this->middleware('permission:branch-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:branch-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the Branch.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(BranchDataTable $dataTable)
    {
        return $dataTable->render('admin.branches.index');
    }


    /**
     * Show the form for creating a new Branch.
     *
     * @return Response
     */
    public function create()
    {
        $cities = $this->cityRepository->all();
        return view('admin.branches.create', compact('cities'));
    }

    /**
     * Store a newly created Branch in storage.
     *
     * @param CreateBranchRequest $request
     *
     * @return Response
     */
    public function store(CreateBranchRequest $request)
    {
        $input = $request->all();

        $branch = $this->branchRepository->createBranch($input);

        $messages = ['success' => "Successfully added", 'redirect' => route('branches.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified Branch.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            $messages = ['success' => "Branch not found", 'redirect' => route('branches.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.branches.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified Branch.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            $messages = ['success' => "Branch not found", 'redirect' => route('branches.index')];
            return response()->json(['messages' => $messages]);

        }
        $cities = $this->cityRepository->all();

        return view('admin.branches.edit', compact('branch', 'cities'));
    }

    /**
     * Update the specified Branch in storage.
     *
     * @param int $id
     * @param UpdateBranchRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBranchRequest $request)
    {
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            $messages = ['success' => "Branch not found", 'redirect' => route('branches.index')];
            return response()->json(['messages' => $messages]);

        }

        $input = $request->all();

        $branch = $this->branchRepository->updateBranch($input, $id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('branches.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified Branch from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $branch = $this->branchRepository->find($id);

        if (empty($branch)) {
            $messages = ['success' => "Branch not found", 'redirect' => route('branches.index')];
            return response()->json(['messages' => $messages]);
        }

        $this->branchRepository->delete($id);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('branches.index')];
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

        $this->branchRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('branches.index')];
        return response()->json(['messages' => $messages]);
    }
}
