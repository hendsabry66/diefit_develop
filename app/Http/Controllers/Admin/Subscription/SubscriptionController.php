<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\DataTables\SubscriptionDataTable;
use App\Http\Requests\CreateSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Repositories\SubscriptionRepository;
use App\Repositories\FoodTypeRepository;
use App\Repositories\TypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\SubscriptionPrice;

class SubscriptionController extends AppBaseController
{
    /** @var SubscriptionRepository $subscriptionRepository*/
    private $subscriptionRepository , $typeRepository , $foodTypeRepository;

    public function __construct(SubscriptionRepository $subscriptionRepo , TypeRepository $typeRepo , FoodTypeRepository $foodTypeRepo)
    {
        $this->subscriptionRepository = $subscriptionRepo;
        $this->typeRepository = $typeRepo;
        $this->foodTypeRepository = $foodTypeRepo;
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
        return view('admin.subscriptions.create')->with('types',$types)->with('foodTypes',$foodTypes);
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
           $input = $request->except('price','food_types');

        $subscription = $this->subscriptionRepository->createSubscription($input);
       // $subscription->foodTypes()->sync($input['food_types']);
       // dd( $input['food_types']);
        if(!empty($request->food_types)) {
            foreach ($request->food_types as $key => $foodType) {

                SubscriptionPrice::create([
                    'subscription_id' => $subscription->id,
                    'food_type' => json_encode($foodType),
                    'price' => $request->price[$key],
                ]);
//
            }
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

        if (empty($subscription)) {
            $messages = ['success' => "Subscription not found", 'redirect' => route('subscriptions.index')];
            return response()->json(['messages' => $messages]);

        }
        $types = $this->typeRepository->all();

        $foodTypes = $this->foodTypeRepository->all();

        return view('admin.subscriptions.edit', compact('subscription','types','foodTypes'));
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

      //  $subscription->foodTypes()->sync($input['food_types']);
      if(isset($input['food_types'])){
            $subscription->foodTypes()->sync($input['food_types']);
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
