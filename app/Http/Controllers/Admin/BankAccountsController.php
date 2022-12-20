<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BankAccountsDataTable;
use App\Http\Requests\CreateBankAccountsRequest;
use App\Http\Requests\UpdateBankAccountsRequest;
use App\Repositories\BankAccountsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BankAccountsController extends AppBaseController
{
    /** @var BankAccountsRepository $bankAccountsRepository*/
    private $bankAccountsRepository;

    public function __construct(BankAccountsRepository $bankAccountsRepo)
    {
        $this->bankAccountsRepository = $bankAccountsRepo;
        $this->middleware('permission:bank-accounts-list|bank-accounts-create|bank-accounts-edit|bank-accounts-delete', ['only' => ['index','show']]);
        $this->middleware('permission:bank-accounts-create', ['only' => ['create','store']]);
        $this->middleware('permission:bank-accounts-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:bank-accounts-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the BankAccounts.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(BankAccountsDataTable $dataTable)
    {
        return $dataTable->render('admin.bank_accounts.index');
    }


    /**
     * Show the form for creating a new BankAccounts.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.bank_accounts.create');
    }

    /**
     * Store a newly created BankAccounts in storage.
     *
     * @param CreateBankAccountsRequest $request
     *
     * @return Response
     */
    public function store(CreateBankAccountsRequest $request)
    {
        $input = $request->all();

        $bankAccounts = $this->bankAccountsRepository->create($input);

        $messages = ['success' => "Successfully added", 'redirect' => route('bankAccounts.index')];
        return response()->json(['messages' => $messages]);

    }

    /**
     * Display the specified BankAccounts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bankAccount = $this->bankAccountsRepository->find($id);

        if (empty($bankAccount)) {
            $messages = ['success' => "Bank Accounts not found", 'redirect' => route('bankAccounts.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.bank_accounts.show', compact('bankAccount'));
    }

    /**
     * Show the form for editing the specified BankAccounts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bankAccount = $this->bankAccountsRepository->find($id);

        if (empty($bankAccount)) {
            $messages = ['success' => "Bank Accounts not found", 'redirect' => route('bankAccounts.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.bank_accounts.edit', compact('bankAccount'));
    }

    /**
     * Update the specified BankAccounts in storage.
     *
     * @param int $id
     * @param UpdateBankAccountsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBankAccountsRequest $request)
    {
        $bankAccounts = $this->bankAccountsRepository->find($id);

        if (empty($bankAccounts)) {
            $messages = ['success' => "Bank Accounts not found", 'redirect' => route('bankAccounts.index')];
            return response()->json(['messages' => $messages]);

        }

        $bankAccounts = $this->bankAccountsRepository->update($request->all(), $id);

        $messages = ['success' => "updated successfully", 'redirect' => route('bankAccounts.index')];
        return response()->json(['messages' => $messages]);

    }

    /**
     * Remove the specified BankAccounts from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bankAccounts = $this->bankAccountsRepository->find($id);

        if (empty($bankAccounts)) {
            $messages = ['success' => "Bank Accounts not found", 'redirect' => route('bankAccounts.index')];
            return response()->json(['messages' => $messages]);

        }

        $this->bankAccountsRepository->delete($id);

        $messages = ['success' => "deleted successfully", 'redirect' => route('bankAccounts.index')];
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

        $messages = ['success' => "Successfully deltetd", 'redirect' => route('bankAccounts.index')];
        return response()->json(['messages' => $messages]);
    }
}
