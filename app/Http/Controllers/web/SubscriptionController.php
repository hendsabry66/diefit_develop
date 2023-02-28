<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BankAccounts;
use App\Models\FoodType;
use App\Models\SubscriptionOrder;
use App\Models\SubscriptionOrderFood;
use App\Models\SubscriptionFoodType;
use App\Models\SubscriptionFood;
use App\Models\SubscriptionPrice;
use App\Models\WeekFood;
use App\Models\Food;
use App\Models\City;
use App\Models\SubscriptionDelivery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\SubscriptionRepository;
use App\Repositories\TypeRepository;
use DateTime;
use DateInterval;
use DatePeriod;
use App\Models\Slider;

class SubscriptionController extends Controller
{
    private $subscriptionRepository, $typeRepository , $subscriptionPrice;

    public function __construct(SubscriptionRepository $subscriptionRepository, TypeRepository $typeRepository , SubscriptionPrice $subscriptionPrice)
    {
        $this->subscriptionRepository = $subscriptionRepository;
        $this->typeRepository = $typeRepository;
        $this->subscriptionPrice = $subscriptionPrice;
    }


    //get all subscription
    public function subscriptions(){
        $subscriptions = $this->subscriptionRepository->all();
        $types = $this->typeRepository->all();
        $cities = City::get();
        $slider = Slider::where('page_type', 'subscription')->orderBy('id','desc')->first();
        return view('web.subscriptions.subscriptions', compact('subscriptions', 'types', 'cities','slider'));
    }

    //save subscription order in database
    public function subscriptionOrder(Request $request){

        // $subscriptionPrice = SubscriptionPrice::find($request->subscription_price_id);
        $subscription = $this->subscriptionRepository->find($request->subscription_id);
        $subscripionOrder = SubscriptionOrder::create([
            'subscription_id' => $subscription->id,
            'user_id' => auth()->user()->id,
            'status_id' => 1,
            'payment_status'=>'not_paid',
            'delivery_cost'=>$request->delivery_cost,
            'specialist_session_number'=>$request->specialist_session_number,
            'calories'=>$request->calories,
            'subscription_delivery_id'=>$request->subscription_delivery_id,
            'snack_id'=>json_encode($request->snacks),
        ]);

        return redirect('subscriptions/orderFood/'.$request->subscription_id.'/'.$subscripionOrder->id);


    }

    //display subscription  food

    public function subscriptionOrderFood($subscription_id,$subscription_order_id){
        $subscription = $this->subscriptionRepository->find($subscription_id);
        $subscriptionOrder = SubscriptionOrder::find($subscription_order_id);
        $period =SubscriptionDelivery::find($subscriptionOrder->subscription_delivery_id)->period;

        $time1 = Carbon::tomorrow();
        $time2 =Carbon::now()->addDay($period);


        $rangeDate=[];
        foreach ($this->dateRange($time1, $time2) as $dt) {
            $rangeDate[] = Carbon::parse($dt)->format('Y-m-d');
        }

        $rangeDay=[];
        foreach ($rangeDate as $value){
            $rangeDay[]=date('D',strtotime($value));
        }

        $dateAndDay = [];
        foreach ($rangeDate as $key=>$value){
            array_push($dateAndDay,[$value,$rangeDay[$key]]);
           // $dateAndDay[$rangeDay[$key]] = $value;
        }

        $rangeDayNumber =["Wed"=>5, "Thu"=>6, "Fri"=>7, "Sat"=>1, "Sun"=>2,"Mon"=>3, "Tue"=>4];
        $days =[5=>"Wed", 6=>"Thu", 7=>"Fri", 1=>"Sat", 2=>"Sun",3=>"Mon", 4=>"Tue"];



        // ****************** //

        $subscription_food_type_id = (SubscriptionFoodType::where('subscription_id', $subscription->id)->where('subscription_delivery_id', $subscriptionOrder->subscription_delivery_id)->first()) ? SubscriptionFoodType::where('subscription_id', $subscription->id)->where('subscription_delivery_id', $subscriptionOrder->subscription_delivery_id)->first()->id : null;

        $food_type_ids = array_unique(SubscriptionFood::where('subscription_food_type_id', $subscription_food_type_id)->pluck('food_type_id')->toArray());

        $food_types = FoodType::whereIn('id', $food_type_ids)->get();

        $array = [];
        if(!empty($food_type_ids)){
            foreach($dateAndDay as $key=>$day){

                foreach ($food_types as $food_type) {
                    $food_ids =  SubscriptionFood::where('subscription_food_type_id', $subscription_food_type_id)->where('food_type_id', $food_type->id)->where('day',$key + 1)->pluck('food_id')->toArray();

                    $array[$key + 1][$food_type->id] = Food::whereIn('id', $food_ids)->get();

                }
            }

//            foreach ($food_types as $food_type) {
//                $food_ids =  SubscriptionFood::where('subscription_food_type_id', $subscription_food_type_id)->where('food_type_id', $food_type->id)->pluck('food_id')->toArray();
//
//                $array[$food_type->id] = Food::whereIn('id', $food_ids)->get();
//
//            }

        }else{
            $food_ids =  SubscriptionFood::where('subscription_food_type_id', $subscription_food_type_id)->where('food_type_id', 0)->pluck('food_id')->toArray();
            $array[] = Food::whereIn('id', $food_ids)->get();

        }

//        $weekFood1 = WeekFood::whereIn('food_type_id', $food_type_ids)->where('day','>=',$rangeDayNumber[date('D',strtotime($time1))])->get();
//
//        $weekFood2 = WeekFood::whereIn('food_type_id', $food_type_ids)->whereNotIn('id',$weekFood1->pluck('id'))->orderBy('day')->get();
//        $weekFood = $weekFood1->merge($weekFood2);
//
//
//        foreach ($weekFood as $key => $value) {
//
//            $array[$value->day][$value->food_type_id][] = $value->food_id;
//
//        }


        return view('web.subscriptions.subscriptionOrderFood',compact('subscription_order_id','subscription','days','dateAndDay','array','food_types'));

    }

    public function subscriptionCreate($subscriptionId,$subscriptionOrderId){

        $subscription = $this->subscriptionRepository->find($subscriptionId);
        $subscriptionOrder = SubscriptionOrder::find($subscriptionOrderId);
        $bankAccounts = BankAccounts::get();
        return view('web.subscriptions.subscriptionConfirmation', compact('subscription','bankAccounts','subscriptionOrder'));

    }

    public function subscriptionStore(Request $request){
       if(auth()->user()->subscriptionOrders()->where('payment_status','paid')->orderBy('id', 'desc')->first()){
           $lastDate =  auth()->user()->subscriptionOrders()->where('payment_status','paid')->orderBy('id', 'desc')->first()->end_date;
           if(! Carbon::now()->gt($lastDate))
           {
               return  redirect()->back()->with('error', __('web.You have already subscribed'));
           }
       }

        $input  = $request->all();
        $subscripionOrder = SubscriptionOrder::find($request->subscription_order_id);
        $period =SubscriptionDelivery::find($subscripionOrder->subscription_delivery_id)->period;


        $input['start_date'] = Carbon::parse(Carbon::now())->format('Y-m-d');
        $input['end_date'] = Carbon::parse(Carbon::now()->addDays($period))->format('Y-m-d');
        $image = $request->file('image');
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/subscription/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']=$imgName;
        }
        $subscripionOrder->update(
            [
                'subscription_id' => $request->subscription_id,
                'user_id' => auth()->user()->id,
                'status_id' => 1,
                'payment' => $request->payment,
                'payment_status' => 'paid',
                'name' => $request->name,
                'account_number' => $request->account_number,
                'amount' => $request->amount,
                'ipan' => $request->ipan,
                'bank_id' => $request->bank_id,
                'image' => $input['image'],
                'start_date' => $input['start_date'],
                'end_date' => $input['end_date'],
            ]
        );


        return redirect()->back()->with('success', __('web.Subscription created successfully'));

    }
    public function dateRange($first, $last)
    {
        $begin = new DateTime($first);
        $end = new DateTime($last);
        $interval = DateInterval::createFromDateString('1 day');
        return new DatePeriod($begin, $interval, $end);
    }




    //subscription order food store
    public function saveSubscriptionOrderFood(Request $request){


        if (isset($request->food_day) && count($request->food_day) < 3  ) {

                    return redirect()->back()->with('error',__('web.Please select at least 3 food'));
        }

        foreach ($request->food_day as $key=>$value) {
            foreach ($value as $k => $v) {
                foreach ($v['food_id'] as $food_id){


                    $subscriptionOrderFood = new SubscriptionOrderFood;
                    $subscriptionOrderFood->subscription_order_id = $request->subscription_order_id ;
                    $subscriptionOrderFood->subscription_id = $request->subscription_id ;
                    $subscriptionOrderFood->user_id = auth()->user()->id ;

                    $subscriptionOrderFood->day = $key ;
                    $subscriptionOrderFood->food_type_id = $k ;
                    $subscriptionOrderFood->food_id = $food_id ;
                    $subscriptionOrderFood->save();

                }
            }
        }
       return redirect('/subscriptions/create/'.$request->subscription_id.'/'.$request->subscription_order_id );
    }


}
