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

