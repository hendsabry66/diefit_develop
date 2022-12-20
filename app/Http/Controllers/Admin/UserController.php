<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\SubscriptionOrderFood;
use App\Models\SubscriptionPrice;
use App\Models\SubscriptionOrder;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Flash;
use Response;
use Hash;
use Auth;
use Redirect;
use DB;

class UserController extends AppBaseController
{
    /** @var UserRepository $userRepository*/
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create')->with('roles',$roles);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = $this->userRepository->create($input);
        $user->assignRole($request->input('roles'));

        $messages = ['success' => "Successfully added", 'redirect' => route('users.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.users.edit')->with('user', $user)->with('roles', $roles)->with('userRole', $userRole);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = $this->userRepository->update($input, $id);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        $messages = ['success' => "Successfully updated", 'redirect' => route('users.index')];
        return response()->json(['messages' => $messages]);
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('users.index')];
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

        $this->userRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deleted", 'redirect' => route('users.index')];
        return response()->json(['messages' => $messages]);
    }
    /**
     * login form
     */
    public function login(){
        return view('admin.login');
    }
    public function postLogin( Request $request){

        request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            return Redirect::to('/admin/dashboard');
        }else{
            return redirect::to('/admin/login')
                ->with('danger',__('admin.username_or_password_notcorrect'));
        }

    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/admin/login');
    }

    public function mySubscription($id){
       $subScriptions = SubscriptionOrder::where('user_id',$id)
           //->where('payment_status','paid')
        ->get();
//        $foodTypes = json_decode(SubscriptionPrice::find(SubscriptionOrderFood::where('user_id',$id)->first()->subscription_price_id)->food_type);
//        $array=[];
//        foreach ($subScriptions as $key => $value) {
//
//            $array[$value->day][$value->food_type_id][] = $value->food_id;
//
//        }
        return view('admin.users.subscriptions',compact('subScriptions'));
    }
}
