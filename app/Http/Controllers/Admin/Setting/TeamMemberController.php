<?php

namespace App\Http\Controllers\Admin\Setting;

use App\DataTables\TeamMemberDataTable;
use App\Http\Requests\CreateTeamMemberRequest;
use App\Http\Requests\UpdateTeamMemberRequest;
use App\Repositories\TeamMemberRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Image;

class TeamMemberController extends AppBaseController
{
    /** @var TeamMemberRepository $teamMemberRepository */
    private $teamMemberRepository;

    public function __construct(TeamMemberRepository $teamMemberRepo)
    {
        $this->teamMemberRepository = $teamMemberRepo;
        $this->middleware('permission:teamMember-list|teamMember-create|teamMember-edit|teamMember-delete', ['only' => ['index','show']]);
        $this->middleware('permission:teamMember-create', ['only' => ['create','store']]);
        $this->middleware('permission:teamMember-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:teamMember-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the TeamMember.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(TeamMemberDataTable $dataTable)
    {
        return $dataTable->render('admin.team_members.index');
    }

    /**
     * Show the form for creating a new TeamMember.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.team_members.create');
    }

    /**
     * Store a newly created TeamMember in storage.
     *
     * @param CreateTeamMemberRequest $request
     *
     * @return Response
     */
    public function store(CreateTeamMemberRequest $request)
    {
        $input = array_except($request->all(),['image']);

        $image = $request->file('image');

        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/teamMember/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']=$imgName;
        }

        $teamMember = $this->teamMemberRepository->create([
            'name' =>[
                'en' => $input['name_en'],
                'ar' => $input['name_ar'],
            ],
            'image' => (isset($input['image'])?$input['image']:null),
            'details' =>[
                'en' => $input['details_en'],
                'ar' => $input['details_ar'],
            ],
        ]);

        $messages = ['success' => "Successfully added", 'redirect' => route('teamMembers.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified TeamMember.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $teamMember = $this->teamMemberRepository->find($id);

        if (empty($teamMember)) {
            Flash::error('TeamMember not found');

            return redirect(route('teamMembers.index'));
        }

        return view('admin.team_members.show')->with('teamMember', $teamMember);
    }

    /**
     * Show the form for editing the specified TeamMember.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $teamMember = $this->teamMemberRepository->find($id);

        if (empty($teamMember)) {
            Flash::error('TeamMember not found');

            return redirect(route('teamMembrs.index'));
        }

        return view('admin.team_members.edit')->with('teamMember', $teamMember);
    }

    /**
     * Update the specified TeamMember in storage.
     *
     * @param int $id
     * @param UpdateTeamMemberRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTeamMemberRequest $request)
    {
        $teamMember = $this->teamMemberRepository->find($id);

        if (empty($teamMember)) {
            Flash::error('TeamMember not found');

            return redirect(route('teamMembers.index'));
        }
        $input = array_except($request->all(),['image']);
        $image = $request->file('image');
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/teamMember/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']= $imgName;
        }
        $teamMember = $this->teamMemberRepository->update([
            'name' =>[
                'en' => $input['name_en'],
                'ar' => $input['name_ar'],
            ],
            'image' => (isset($input['image'])?$input['image']:$teamMember->image),
            'details' =>[
                'en' => $input['details_en'],
                'ar' => $input['details_ar'],
            ],
        ], $id);

        $messages = ['success' => "Successfully updated", 'redirect' => route('teamMembers.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified TeamMember from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $teamMember = $this->teamMemberRepository->find($id);

        if (empty($teamMember)) {
            Flash::error('TeamMember not found');

            return redirect(route('teamMembers.index'));
        }

        $this->teamMemberRepository->delete($id);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('teamMembers.index')];
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

        $this->teamMemberRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('teamMembers.index')];
        return response()->json(['messages' => $messages]);
    }
}
