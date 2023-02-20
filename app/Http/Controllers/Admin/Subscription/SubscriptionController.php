<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\DataTables\SubscriptionDataTable;
use App\Http\Requests\CreateSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Repositories\SubscriptionRepository;
use App\Repositories\FoodTypeRepository;
use App\Repositories\TypeRepository;
use App\Repositories\FoodRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\SubscriptionPrice;
use App\Models\SubscriptionFood;
use App\Models\SubsrcriptionFoodIngredient;
use App\Models\SubscriptionDelivery;
use App\Models\Food;
use App\Models\SubscriptionSnack;

class SubscriptionController extends AppBaseController
{
    /** @var SubscriptionRepository $subscriptionRepository*/
    private $subscriptionRepository , $typeRepository , $foodTypeRepository, $foodRepository;

    public function __construct(SubscriptionRepository $subscriptionRepo , TypeRepository $typeRepo , FoodTypeRepository $foodTypeRepo , FoodRepository $foodRepo)
    {
        $this->subscriptionRepository = $subscriptionRepo;
        $this->typeRepository = $typeRepo;
        $this->foodTypeRepository = $foodTypeRepo;
        $this->foodRepository = $foodRepo;


        $this->middleware('permission:subscription-list|subscription-create|subscription-edit|subscription-delete', ['only' => ['index','show']]);
        $this->middleware('permission:subscription-create', ['only' => ['create','store']]);
        $this->middleware('permission:subscription-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:subscription-delete', ['only' => ['destroy']]);
    }



    /**
     * Display a listing of the Subscription.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(SubscriptionDataTable $dataTable)
    {
        return $dataTable->render('admin.subscriptions.index');
    }


    /**
     * Show the form for creating a new Subscription.
     *
     * @return Response
     */
    public function create()
    {
        $types = $this->typeRepository->all();
        $foodTypes = $this->foodTypeRepository->all();
        $foods = $this->foodRepository->all();
        return view('admin.subscriptions.create', compact('types' , 'foodTypes' , 'foods'));
    }

    /**
     * Store a newly created Subscription in storage.
     *
     * @param CreateSubscriptionRequest $request
     *
     * @return Response
     */
    public function store(CreateSubscriptionRequest $request)
    {


        $input = $request->except(['_token' , 'number_of_delivery_days' , 'period']);

        $gram_array = [];
        if($request->has_calories == 0){
            foreach ($request->grams as $key=>$gram){
                $gram_array[$request->prices[$key]]=$gram;
            }
            $input['grams'] = json_encode($gram_array);
        }
        $subscription = $this->subscriptionRepository->createSubscription($input);

        //snacks
//        if(isset($input['snacks'])){
//            foreach ($input['snacks'] as $key=>$snack){
//                $subscriptionSnack = SubscriptionSnack::create([
//                    'subscription_id' => $subscription->id,
//                    'food_id' => $snack,
//                    'price' => $input['snack_prices'][$key],
//                ]);
//            }
//        }


//        if(isset($input['foodsitems'])) {
//
//            foreach ($input['foodsitems'] as $key=>$food) {
//
//                foreach ($food as $key2=>$value){
//
//                    $subscriptionFood = SubscriptionFood::create([
//                        'subscription_id' => $subscription->id,
//                        'food_id' => $key2,
//                        'food_type_id' => $key,
//                    ]);
//
//                    foreach ($value['ingrediant'] as $key3=>$ingredient){
//
//                        SubsrcriptionFoodIngredient::create([
//                            'subscription_food_id' => $subscriptionFood->id,
//                            'ingredient' => $ingredient,
//                            'qty' => $value['quantity'][$key3],
//                        ]);
//                    }
//
//                }
//
////                foreach ($input['foodsitems'][$food]['ingrediant'] as $key => $item) {
////
////                    SubsrcriptionFoodIngredient::create([
////                        'subscription_food_id' => $subscription_food->id,
////                        'ingredient' => $item,
////                        'qty' => $input['foodsitems'][$food]['quantity'][$key],
////                    ]);
////                }
//            }
//        }else{
//            $subscription->delete();
//            $messages = ['errors' => "    يجب ادخال وجبات للاشتراك ", 'redirect' => ''];
//
//            return response()->json(['messages' => $messages]);
//        }

        if(!empty($request->number_of_delivery_days) && $request->number_of_delivery_days[0] != null) {

            foreach ($request->number_of_delivery_days  as $key => $value) {
                SubscriptionDelivery::create([
                    'subscription_id' => $subscription->id,
                    'number_of_delivery_days' => $value,
                    'period' => $request->period[$key],
                ]);

            }

        }else{
            $subscription->delete();
            $messages = ['errors' => "مدة التوصيل  مطلوبه  ", 'redirect' => ''];

            return response()->json(['messages' => $messages]);
        }

        $messages = ['success' => "Successfully added", 'redirect' => route('subscriptions.index')];
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
        $types = $this->typeRepository->all();
        $foodTypes = $this->foodTypeRepository->all();
        $foods = $this->foodRepository->all();


        if (empty($subscription)) {
            $messages = ['success' => "Subscription not found", 'redirect' => route('subscriptions.index')];
            return response()->json(['messages' => $messages]);

        }


        return view('admin.subscriptions.edit', compact('subscription' , 'foods', 'types' , 'foodTypes'));
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
