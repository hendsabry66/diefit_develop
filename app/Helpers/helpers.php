<?php

function settings(){
    $array =[];
    foreach(\App\Models\Setting::all() as $key=>$value){
        $array[$value->key] = $value->value;
    }
    return $array;

}
function getCartCount(){
    $count = 0;
    if(\Auth::check()){
        $count = \App\Models\Cart::where('user_id',\Auth::user()->id)->sum('quantity');
        if($count == 0){
            $count = \App\Models\RestaurantCart::where('user_id',\Auth::user()->id)->sum('quantity');
        }
    }
    return $count;
}
function types($value){
    return \App\Models\Type::where('food_type',$value)->get();
}
function sendSMS($message,$mobileNumber)
{
    $user = 'Dietfit';
    $password = 'Dietfit@12';
    $sendername = 'Dietfit';
    $text = urlencode( $message);
    $to = $mobileNumber;
    // auth call
    $url = "https://www.4jawaly.net/api/sendsms.php?username=$user&password=$password&numbers=$to&message=$text&sender=$sendername&unicode=E&return=full";

    $ret = file_get_contents($url);
    echo nl2br($ret);
}

//get subscription_foods
function SubscriptionFoods($subscription_food_type_id, $day, $food_type_id){
  return   \App\Models\SubscriptionFood::where('subscription_food_type_id', $subscription_food_type_id)->where('day',$day)->where('food_type_id',$food_type_id)
        ->pluck("food_id")->toArray();
}


