<?php

namespace App\Http\Controllers\Admin\Setting;

use App\DataTables\ClientReviewDataTable;
use App\Http\Requests\CreateClientReviewRequest;
use App\Http\Requests\UpdateClientReviewRequest;
use App\Repositories\ClientReviewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Image;

class ClientReviewController extends AppBaseController
{
    /** @var ClientReviewRepository $clientReviewRepository*/
    private $clientReviewRepository;

    public function __construct(ClientReviewRepository $clientReviewRepo)
    {
        $this->clientReviewRepository = $clientReviewRepo;
        //        $this->middleware('permission:clientReview-list|clientReview-create|clientReview-edit|clientReview-delete', ['only' => ['index','show']]);
//        $this->middleware('permission:clientReview-create', ['only' => ['create','store']]);
//        $this->middleware('permission:clientReview-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:clientReview-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the ClientReview.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(ClientReviewDataTable $dataTable)
    {
        return $dataTable->render('admin.client_reviews.index');
    }

    /**
     * Show the form for creating a new ClientReview.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.client_reviews.create');
    }

    /**
     * Store a newly created ClientReview in storage.
     *
     * @param CreateClientReviewRequest $request
     *
     * @return Response
     */
    public function store(CreateClientReviewRequest $request)
    {
        $input = $request->all();

        $clientReview = $this->clientReviewRepository->createClientReview($input);
        $messages = ['success' => "Successfully added", 'redirect' => route('clientReviews.index')];
        return response()->json(['messages' => $messages]);

    }

    /**
     * Display the specified ClientReview.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clientReview = $this->clientReviewRepository->find($id);

        if (empty($clientReview)) {
            $messages = ['success' => "Client Review not found", 'redirect' => route('clientReviews.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.client_reviews.show', compact('clientReview'));

    }

    /**
     * Show the form for editing the specified ClientReview.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clientReview = $this->clientReviewRepository->find($id);

        if (empty($clientReview)) {
            $messages = ['success' => "Client Review not found", 'redirect' => route('clientReviews.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.client_reviews.edit', compact('clientReview'));
    }

    /**
     * Update the specified ClientReview in storage.
     *
     * @param int $id
     * @param UpdateClientReviewRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClientReviewRequest $request)
    {
        $clientReview = $this->clientReviewRepository->find($id);

        if (empty($clientReview)) {
            $messages = ['success' => "Client Review not found", 'redirect' => route('clientReviews.index')];
            return response()->json(['messages' => $messages]);

        }
        $input = array_except($request->all(),['image']);

        $clientReview = $this->clientReviewRepository->updateClientReview($input, $id);
        $messages = ['success' => "Successfully updated", 'redirect' => route('clientReviews.index')];
        return response()->json(['messages' => $messages]);

    }

    /**
     * Remove the specified ClientReview from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $clientReview = $this->clientReviewRepository->find($id);

        if (empty($clientReview)) {
            $messages = ['success' => "Client Review not found", 'redirect' => route('clientReviews.index')];
            return response()->json(['messages' => $messages]);

        }

        $this->clientReviewRepository->delete($id);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('clientReviews.index')];
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

        $this->clientReviewRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('clientReviews.index')];
        return response()->json(['messages' => $messages]);
    }
}
