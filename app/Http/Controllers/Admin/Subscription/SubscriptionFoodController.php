<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\SubscriptionFoodDataTable;
use App\Models\SubscriptionDelivery;
use App\Models\SubscriptionFood;
use App\Models\SubscriptionFoodType;

class SubscriptionFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubscriptionFoodDataTable $dataTable)
    {
        return $dataTable->render('admin.subscriptionfoods.index');
    }


    /**
     * Show the form for creating a new Subscription.
     *
     * @return Response
     */
    public function create()
    {
        $subscriptions = \App\Models\Subscription::get();
        return view('admin.subscriptionfoods.create', compact('subscriptions'));
    }

    public function getSubscriptionDelivery($subscription_id)
    {
        $subscription_delivery = SubscriptionDelivery::where('subscription_id', $subscription_id)->pluck("period","id");;
        return response()->json($subscription_delivery);
    }

    public function getSubscriptionFoods($subscription_delivery_id)
    {
        $period = SubscriptionDelivery::find($subscription_delivery_id)->period;
        $foodTypes = \App\Models\FoodType::get();
        $foods = \App\Models\Food::get();
       return view('admin.subscriptionfoods.days', compact('period', 'foodTypes', 'foods'));
    }

    /**
     * Store a newly created Subscription in storage.
     *
     * @param CreateSubscriptionRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $subscription_food_type = new SubscriptionFoodType;
        $subscription_food_type->subscription_delivery_id =$request->subscription_delivery_id;
        $subscription_food_type->subscription_id =$request->subscription_id;
        $subscription_food_type->save();

        foreach ($request->foods as $key=>$food){
            //$day == $key
            foreach ($food as $foodType=>$value){


                foreach ($value as $foodId){
                    $subscription_food = SubscriptionFood::create([
                        'food_id'=>$foodId,
                        'subscription_food_type_id'=>$subscription_food_type->id,
                        'food_type_id'=>$foodType,
                        'day'=>$key,
                    ]);

                }
            }
        }


        $messages = ['success' => "Successfully added", 'redirect' => route('subscriptionFoods.index')];
        return response()->json(['messages' => $messages]);

    }

    /**
     * Display the specified Subscription.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            $messages = ['success' => "Subscription not found", 'redirect' => route('subscriptions.index')];
            return response()->json(['messages' => $messages]);

        }

        return view('admin.subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified Subscription.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subscriptions = \App\Models\Subscription::get();
        $subscriptionFoodType = SubscriptionFoodType::find($id);
        $subscription_delivery = SubscriptionDelivery::where('subscription_id', $subscriptionFoodType->subscription_id)->get();
        $selected_subscription_delivery = SubscriptionDelivery::where('id', $subscriptionFoodType->subscription_delivery_id)->first();
        $foodTypes = \App\Models\FoodType::get();
        $foods = \App\Models\Food::get();
        $subscription_foods = SubscriptionFood::where('subscription_food_type_id', $id)->get();

        return view('admin.subscriptionfoods.edit', compact('subscriptionFoodType', 'subscriptions','subscription_delivery','selected_subscription_delivery','foodTypes','foods','subscription_foods'));
    }

    /**
     * Update the specified Subscription in storage.
     *
     * @param int $id
     * @param UpdateSubscriptionRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

        $subscription_food_type =SubscriptionFoodType::find($id);
        $subscription_food_type->subscription_delivery_id =$request->subscription_delivery_id;
        $subscription_food_type->subscription_id =$request->subscription_id;
        $subscription_food_type->save();

        SubscriptionFood::where('subscription_food_type_id', $id)->delete();

        foreach ($request->foods as $key=>$food){
            //$day == $key
            foreach ($food as $foodType=>$value){


                foreach ($value as $foodId){
                    $subscription_food = SubscriptionFood::create([
                        'food_id'=>$foodId,
                        'subscription_food_type_id'=>$subscription_food_type->id,
                        'food_type_id'=>$foodType,
                        'day'=>$key,
                    ]);

                }
            }
        }

        $messages = ['success' => "Successfully updated", 'redirect' => route('subscriptionFoods.index')];
        return response()->json(['messages' => $messages]);

    }

    /**
     * Remove the specified Subscription from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subscription_food_type =SubscriptionFoodType::find($id);

        SubscriptionFood::where('subscription_food_type_id', $id)->delete();

        $subscription_food_type->delete();

        $messages = ['success' => "Successfully deletd", 'redirect' => route('subscriptionFoods.index')];
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

        $this->typeRepository->bulkDelete($request->ids);

        $messages = ['success' => "Successfully deltetd", 'redirect' => route('subscriptions.index')];
        return response()->json(['messages' => $messages]);
    }
}
