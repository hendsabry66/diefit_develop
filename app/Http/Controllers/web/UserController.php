<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RestaurantOrder;
use App\Models\SubscriptionOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\City;
use Image;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function register()
    {
        $cities = \App\Models\City::all();
        return view('web.users.register')->with('cities', $cities);
    }


    public function postRegister(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:6',
            'city_id' => 'required',
        ]);
      	$code = rand(1000,9999);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['code'] = $code;
        $user = User::create($input);
      	sendSMS($code,$user->phone);
        return redirect('/code/' . $user->id);
    }



    public function code($user_id,$type=null)
    {

        return view('web.users.code')->with('user_id', $user_id)->with('type', $type);
    }

    public function postCode(Request $request)
    {

        if($request->type == 'reset'){

            $user = User::find($request->user_id);
            $input = $request->all();
            $code = $input['number1'] . $input['number2'] . $input['number3'] . $input['number4'];

            if($user->code == $code){
                return redirect('/resetPassword/' . $user->id);
            }
            return redirect('/code/' . $user->id);
        }else{
            $input = $request->all();
            $user = User::find($input['user_id']);
            $code = $input['number1'] . $input['number2'] . $input['number3'] . $input['number4'];
            if ($user->code == $code) {
                $user->status = 'active';
                $user->code = null;
                $user->save();
                return redirect('login');
            } else {
                return redirect('/code/' . $input['user_id']);
            }
        }

    }


    public function login()
    {
        return view('web.users.login');
    }


    public function postLogin(Request $request)
    {

        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('phone', 'password');
        $user = User::where('phone', $request->phone)->first();
        if(!empty($user)) {
            if ($user->status == 'active') {
                if (Auth::attempt($credentials)) {
                    return redirect('/');
                } else {
                    return redirect('login')->with('error', __('web.Wrong phone or password'));
                }
            } else {
                return redirect('/login')->with('error', 'Your account is not active yet');
            }
        }else{
            return redirect('login')->with('error', __('web.Wrong phone or password'));
        }
    }

    public function logout() {
        Auth::logout();

        return redirect('login');
    }

    public function profile()
    {
        $user = Auth::user();
        $storeOrders = Order::where('user_id', $user->id)->count();
        $storeOrdersCompleted = Order::where('user_id', $user->id)->where('status_id', 5)->count();
        $restaurantOrders = RestaurantOrder::where('user_id', $user->id)->count();
        $restaurantOrdersCompleted = RestaurantOrder::where('user_id', $user->id)->where('status_id', 5)->count();
        $currentSubscription  = (SubscriptionOrder::where('user_id', $user->id)->where('end_date','>=',date('Y-m-d'))->first()) ? SubscriptionOrder::where('user_id', $user->id)->where('end_date','>=',date('Y-m-d'))->first()->subscriptionPrice->subscription->name : '-';
        if(SubscriptionOrder::where('user_id', $user->id)->where('end_date','>=',date('Y-m-d'))->first()){

        	$enddate = SubscriptionOrder::where('user_id', $user->id)->where('end_date','>=',date('Y-m-d'))->first()->end_date;
        	$end = Carbon::parse($enddate);
        	$remainingdays = $end->diffInDays(Carbon::now());
        }else{
          $remainingdays = 0 ;
        }



        return view('web.users.profile', compact('user', 'storeOrders', 'storeOrdersCompleted', 'restaurantOrders', 'restaurantOrdersCompleted','currentSubscription','remainingdays'));
    }
    public function additionalData(){
        $user = Auth::user();
        return view('web.users.additional_data_user', compact('user'));
    }

    public function updateAdditionalData(Request $request){

        $user = Auth::user();
        $user->update($request->all());
        return redirect()->back()->with('success', __('web.Data updated successfully'));
    }


    public function showForgetPasswordForm()
    {
        return view('web.users.forget');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

         $user = User::where('phone', $request->phone)->first();
        if($user) {
          $code = rand(1000,9999);
            $user->code = $code;
            $user->save();
          	sendSMS($code,$user->phone);
            return redirect('/code/' . $user->id.'/reset');
        }
        return back()->with('error', __('web.Wrong phone'));
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function showResetPasswordForm($user_id) {
        return view('web.users.ResetPasswordForm', ['user_id' => $user_id]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);


        $user = User::where('phone', $request->phone)
            ->update(['password' => Hash::make($request->password),'code' => null]);


        return redirect('/login')->with('success', __('web.Your password changed'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        $cities = City::all();
        return view('web.users.edit_profile', compact('user', 'cities'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $image = $request->file('image');
        $data = $request->all();
        if(!empty($image)){
            // for save original image

            $img = Image::make($image);
            $imgPath = 'uploads/user/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $data['image']=$imgName;
        }
        $user->update($data);
        return redirect()->back()->with('success', __('web.Data updated successfully'));
    }

}
