<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BankAccounts;
use App\Models\FoodType;
use App\Models\SubscriptionOrder;
use App\Models\SubscriptionOrderFood;
use App\Models\SubscriptionPrice;
use App\Models\WeekFood;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\SubscriptionRepository;
use App\Repositories\TypeRepository;
use DateTime;
use DateInterval;
use DatePeriod;

class SubscriptionController extends Controller
{
    private $subscriptionRepository, $typeRepository , $subscriptionPrice;

    public function __construct(SubscriptionRepository $subscriptionRepository, TypeRepository $typeRepository , SubscriptionPrice $subscriptionPrice)
    {
        $this->subscriptionRepository = $subscriptionRepository;
        $this->typeRepository = $typeRepository;
        $this->subscriptionPrice = $subscriptionPrice;
    }



    public function subscriptions(){
        $subscriptions = $this->subscriptionRepository->all();
        $types = $this->typeRepository->all();
        return view('web.subscriptions.subscriptions', compact('subscriptions', 'types'));
    }
    public function subscriptionCreate($subscriptionPriceId){
        $subscriptionPrice = SubscriptionPrice::find($subscriptionPriceId);
        $bankAccounts = BankAccounts::get();
        return view('web.subscriptions.subscriptionConfirmation', compact('subscriptionPrice','bankAccounts'));

    }

    public function subscriptionStore(Request $request){
       if(auth()->user()->subscriptionOrders()->orderBy('id', 'desc')->first()){
           $lastDate =  auth()->user()->subscriptionOrders()->orderBy('id', 'desc')->first()->end_date;
           if(! Carbon::now()->gt($lastDate))
           {
               return  redirect()->back()->with('error', __('web.You have already subscribed'));
           }
       }

        $input  = $request->all();
        $subscripionPrice = SubscriptionPrice::find($input['subscription_price_id']);
        $input['start_date'] = Carbon::parse(Carbon::now())->format('Y-m-d');
        $input['end_date'] = Carbon::parse(Carbon::now()->addDays($subscripionPrice->subscription->period))->format('Y-m-d');
        $image = $request->file('image');
        if(!empty($image)){
            // for save original image
            $img = Image::make($image);
            $imgPath = 'uploads/subscription/';
            $imgName =time().$image->getClientOriginalName();
            $img =  $img->save($imgPath.$imgName);
            $input['image']=$imgName;
        }
        $subscripionOrder = SubscriptionOrder::create([
            'subscription_price_id' => $request->subscription_price_id,
            'user_id' => auth()->user()->id,
            'status_id' => 1,
            'payment' => $request->payment,
            'name' => $request->name,
            'account_number' => $request->account_number,
            'amount' => $request->amount,
            'ipan' => $request->ipan,
            'bank_id' => $request->bank_id,
            'image' => $input['image'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
        ]);

        return redirect('subscriptions/orderFood/'.$request->subscription_price_id.'/'.$subscripionOrder->id);

    }
    public function dateRange($first, $last)
    {
        $begin = new DateTime($first);
        $end = new DateTime($last);
        $interval = DateInterval::createFromDateString('1 day');
        return new DatePeriod($begin, $interval, $end);
    }

    public function subscriptionOrder($subscriptionPriceId){
        $subscriptionPrice = SubscriptionPrice::find($subscriptionPriceId);
        $subscripionOrder = SubscriptionOrder::create([
            'subscription_price_id' => $subscriptionPrice->id,
            'user_id' => auth()->user()->id,
            'status_id' => 1,
            'payment_status'=>'not_paid'
        ]);

        return redirect('subscriptions/orderFood/'.$subscriptionPriceId.'/'.$subscripionOrder->id);


    }

    public function subscriptionOrderFood($subscription_price_id,$subscription_order_id){
        $time1 = Carbon::tomorrow();
        $time2 =Carbon::now()->addDay(7);

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
            $dateAndDay[$rangeDay[$key]] = $value;
        }

        $rangeDayNumber =["Wed"=>5, "Thu"=>6, "Fri"=>7, "Sat"=>1, "Sun"=>2,"Mon"=>3, "Tue"=>4];
        $days =[5=>"Wed", 6=>"Thu", 7=>"Fri", 1=>"Sat", 2=>"Sun",3=>"Mon", 4=>"Tue"];

        // ****************** //
        $food_type_ids = json_decode(SubscriptionPrice::find($subscription_price_id)->food_type);
        $food_types = FoodType::whereIn('id', $food_type_ids)->get();
        $weekFood1 = WeekFood::whereIn('food_type_id', $food_type_ids)->where('day','>=',$rangeDayNumber[date('D',strtotime($time1))])->get();

         $weekFood2 = WeekFood::whereIn('food_type_id', $food_type_ids)->whereNotIn('id',$weekFood1->pluck('id'))->orderBy('day')->get();
         $weekFood = $weekFood1->merge($weekFood2);
        $array = [];

        foreach ($weekFood as $key => $value) {

            $array[$value->day][$value->food_type_id][] = $value->food_id;

        }

        return view('web.subscriptions.subscriptionOrderFood', compact('food_types', 'array','subscription_price_id','subscription_order_id','days','dateAndDay'));
    }

    public function saveSubscriptionOrderFood(Request $request){

        $array =[];
        foreach ($request->day as $data) {
            if (isset($data['food_id'])) {
                array_push($array, $data['food_id']);
            }
        }
        if(count($array) < 3 ){
            return redirect()->back()->with('error',__('web.Please select at least 3 food'));
        }
        foreach ($request->day as $key=>$value) {
            if (isset($value['food_id'])) {
                foreach ($value['food_type_id'] as $k => $v) {

                    $subscriptionOrderFood = new SubscriptionOrderFood;
                    $subscriptionOrderFood->subscription_order_id = $request->subscription_order_id ;
                    $subscriptionOrderFood->subscription_price_id = $request->subscription_price_id ;
                    $subscriptionOrderFood->user_id = auth()->user()->id ;
                    $subscriptionOrderFood->day = $key . '/' . $value['day'] . '/' . $value['date'] ;
                    $subscriptionOrderFood->food_type_id = $v ;
                    $subscriptionOrderFood->food_id = $value['food_id'][$k] ;
                    $subscriptionOrderFood->save();

                }
            }
        }
       return redirect('/subscriptions/create/'.$request->subscription_price_id);
    }


}
