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

        $subscription = $this->subscriptionRepository->find($id);
        $foods = $this->foodRepository->all();
        $types = $this->typeRepository->all();
        $foodTypes = $this->foodTypeRepository->all();
        $subscription_foods = [];
        foreach ($subscription->subscriptionFoods->pluck('food_id','id')->toArray() as $key=>$food) {

            $subscription_foods[$key]['id'] = Food::find($food)->id;
            $subscription_foods[$key]['name'] = Food::find($food)->name;
            $subscription_foods[$key]['ingrediants'] = SubsrcriptionFoodIngredient::where('subscription_food_id',$key)->select('ingredient','qty')->get()->toArray();
        }

        if (empty($subscription)) {
            $messages = ['success' => "Subscription not found", 'redirect' => route('subscriptions.index')];
            return response()->json(['messages' => $messages]);

        }
//        $foodTypesSelected =[];
//        foreach ($subscription->subscriptionPrices as $item) {
//            foreach (json_decode($item->food_type) as $v) {
//                array_push($foodTypesSelected,$v) ;
//            }
//
//
//        }
//
//
//        $types = $this->typeRepository->all();
//
//        $foodTypes = $this->foodTypeRepository->all();

        return view('admin.subscriptions.edit', compact('subscription' , 'foods', 'types' , 'foodTypes','subscription_foods'));
    }

    /**
     * Update the specified Subscription in storage.
     *
     * @param int $id
     * @param UpdateSubscriptionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubscriptionRequest $request)
    {
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            $messages = ['success' => "Subscription not found", 'redirect' => route('subscriptions.index')];
            return response()->json(['messages' => $messages]);

        }


        $input = $request->all();

        $subscription = $this->subscriptionRepository->updateSubscription($input, $id);

        if(!empty($input['foods'])){
            foreach(SubscriptionFood::where('subscription_id',$id)->get() as $item){

                SubsrcriptionFoodIngredient::where('subscription_food_id',$item->id)->delete();
                $item->delete();
            }
            foreach ($input['foods'] as $food) {
                $subscription_food = SubscriptionFood::create([
                    'subscription_id' => $subscription->id,
                    'food_id' => $food,
                ]);
                SubsrcriptionFoodIngredient::where('subscription_food_id',$subscription_food->id)->delete();
                foreach ($input['foodsitems'][$food]['ingrediant'] as $key=>$item) {

                    SubsrcriptionFoodIngredient::create([
                        'subscription_food_id' => $subscription_food->id,
                        'ingredient' => $item,
                        'qty' => $input['foodsitems'][$food]['quantity'][$key],
                    ]);
                }
            }
        }
        if (!empty($input['number_of_delivery_days'])) {
            $subscription->subscriptionDelivery()->delete();
            foreach ($request->number_of_delivery_days  as $key => $value) {
                SubscriptionDelivery::create([
                    'subscription_id' => $subscription->id,
                    'number_of_delivery_days' => $value,
                    'period' => $request->period[$key],
                ]);

            }
        }
        $messages = ['success' => "Successfully updated", 'redirect' => route('subscriptions.index')];
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
        $subscription = $this->subscriptionRepository->find($id);

        if (empty($subscription)) {
            $messages = ['success' => "Subscription not found", 'redirect' => route('subscriptions.index')];
            return response()->json(['messages' => $messages]);

        }

        $this->subscriptionRepository->delete($id);

        $messages = ['success' => "Successfully deletd", 'redirect' => route('subscriptions.index')];
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
