<?php

namespace App\Http\Controllers\Admin\Food;

use App\DataTables\ExtraDataTable;
use App\Http\Requests\CreateExtraRequest;
use App\Http\Requests\UpdateExtraRequest;
use App\Repositories\ExtraRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ExtraController extends AppBaseController
{
    /** @var extraRepository $extraRepository*/
    private $extraRepository;

    public function __construct(ExtraRepository $extraRepo)
    {
        $this->extraRepository = $extraRepo;
    }

    /**
     * Display a listing of the Extra.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(ExtraDataTable $dataTable)
    {
        return $dataTable->render('admin.extras.index');
    }

    /**
     * Show the form for creating a new Extra.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.extras.create');
    }

    /**
     * Store a newly created Extra in storage.
     *
     * @param CreateExtraRequest $request
     *
     * @return Response
     */
    public function store(CreateExtraRequest $request)
    {
          $input = $request->except('price','value');

        $extra = $this->extraRepository->createExtra($input);
        if(!empty($request->price)){
          foreach ($request->price as $key => $value) {
              $extra->values()->create([
                  'price' => $value,
                  'value' => $request->value[$key],
              ]);
          }
        }

        $messages = ['success' => "Successfully added", 'redirect' => route('extras.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified Extra.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $extra = $this->extraRepository->find($id);

        if (empty($extra)) {
            $messages = ['success' => "Extra not found", 'redirect' => route('extras.index')];
            return response()->json(['messages' => $messages]);
        }

        return view('admin.extras.show', compact('extra'));
    }

    /**
     * Show the form for editing the specified Extra.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $extra = $this->extraRepository->find($id);

        if (empty($extra)) {
            $messages = ['success' => "Extra not found", 'redirect' => route('extras.index')];
            return response()->json(['messages' => $messages]);
        }

        return view('admin.extras.edit', compact('extra'));
    }

    /**
     * Update the specified Extra in storage.
     *
     * @param int $id
     * @param UpdateExtraRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExtraRequest $request)
    {
        $extra = $this->extraRepository->find($id);

        if (empty($extra)) {
            $messages = ['success' => "Extra not found", 'redirect' => route('extras.index')];
            return response()->json(['messages' => $messages]);
        }

        $input = $request->all();
        $extra = $this->extraRepository->updateExtra($input, $id);
        $extra->values()->delete();
        foreach ($request->price as $key => $value) {
            $extra->values()->create([
                'price' => $value,
                'value' => $request->value[$key],
            ]);
        }
        $messages = ['success' => "Successfully updated", 'redirect' => route('extras.index')];
        return response()->json(['messages' => $messages]);

    }

    /**
     * Remove the specified extra from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $extra = $this->extraRepository->find($id);

        if (empty($extra)) {
            $messages = ['success' => "Extra not found", 'redirect' => route('extras.index')];
            return response()->json(['messages' => $messages]);
        }

        $this->extraRepository->delete($id);
        $messages = ['success' => "Successfully deleted", 'redirect' => route('extras.index')];
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

        $this->extraRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('extras.index')];
        return response()->json(['messages' => $messages]);
    }

}
