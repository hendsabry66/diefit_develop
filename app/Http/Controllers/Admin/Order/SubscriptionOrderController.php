<?php


namespace App\Http\Controllers\Admin\Order;


use App\Http\Controllers\AppBaseController;
use App\DataTables\SubscriptionOrdersDataTable;
use App\Models\SubscriptionOrder;
use App\Models\User;
use App\Notifications\SubscriptionNotification;
use App\Repositories\SubscriptionOrderRepository;
use App\Repositories\StatusRepository;
use Illuminate\Http\Request;

class SubscriptionOrderController extends AppBaseController
{
    private $subscriptionOrderRepository , $statusRepository;

    public function __construct(SubscriptionOrderRepository $subscriptionOrderRepository , StatusRepository $statusRepository)
    {
        $this->subscriptionOrderRepository = $subscriptionOrderRepository;
        $this->statusRepository = $statusRepository;
    }


    public function index(SubscriptionOrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.orders.subscription.index');
    }

    public function show($id)
    {
        $order = $this->subscriptionOrderRepository->find($id);
        return view('admin.orders.subscription.show', compact('order'));
    }

    public function edit($id)
    {
        $order = $this->subscriptionOrderRepository->find($id);
        $statuses = $this->statusRepository->all();
        return view('admin.orders.subscription.edit', compact('order', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $order = $this->subscriptionOrderRepository->find($id);
        $order->status_id = $request->status;
        $order->save();
        $messages = ['success' => "updatedSuccessfully", 'redirect' => route('subscriptionOrders.index')];
        return response()->json(['messages' => $messages]);
    }

    public function destroy($id)
    {
        $order = $this->subscriptionOrderRepository->find($id);
        $order->delete();
        $messages = ['success' => "deletedSuccessfully", 'redirect' => route('subscriptionOrders.index')];
        return response()->json(['messages' => $messages]);
    }
    public function sendNotification($id){
        $order = $this->subscriptionOrderRepository->find($id);


        $user = User::find($order->user_id);

        $details = [
            'greeting' => 'Hi '.$user->name,
            'body' => 'please fill the meals to complete your subscription',
            'thanks' => 'Thank you ',
        ];

        \Notification::send($user, new SubscriptionNotification($details));

        $messages = ['success' => "notification send successfully", 'redirect' => route('subscriptionOrders.index')];
        return response()->json(['messages' => $messages]);
    }
    public function subscriptionOrderPendding(SubscriptionOrdersDataTable $dataTable ,$status){
        return $dataTable->render('admin.orders.subscription.index');
    }

}
