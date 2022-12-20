<?php
namespace App\Http\Controllers\Admin\Order;


use App\Http\Controllers\AppBaseController;
use App\DataTables\RestaurantOrdersDataTable;
use App\Models\RestaurantOrder;
use App\Repositories\RestaurantOrderRepository;
use App\Repositories\StatusRepository;
use Illuminate\Http\Request;

class RestaurantOrderController  extends AppBaseController
{
    private $restaurantOrderRepository , $statusRepository;
    public function __construct(RestaurantOrderRepository $restaurantOrderRepo , StatusRepository $statusRepo)
    {
        $this->restaurantOrderRepository = $restaurantOrderRepo;
        $this->statusRepository = $statusRepo;
        $this->middleware('permission:restaurant-order-list|restaurant-order-create|restaurant-order-edit|restaurant-order-delete', ['only' => ['index','show']]);
        $this->middleware('permission:restaurant-order-create', ['only' => ['create','store']]);
        $this->middleware('permission:restaurant-order-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:restaurant-order-delete', ['only' => ['destroy']]);
    }

    public function index( RestaurantOrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.orders.restaurant.index');
    }

    public function show($id)
    {
        $order = $this->restaurantOrderRepository->find($id);
        return view('admin.orders.restaurant.show', compact('order'));
    }

    public function edit($id)
    {
        $order = $this->restaurantOrderRepository->find($id);
        $statuses = $this->statusRepository->all();
        return view('admin.orders.restaurant.edit', compact('order', 'statuses'));
    }
    public function update(Request $request, $id)
    {
        $order = $this->restaurantOrderRepository->find($id);
        $order->status_id = $request->status;
        $order->save();
        $messages = ['success' => "updatedSuccessfully", 'redirect' => route('restaurantOrders.index')];
        return response()->json(['messages' => $messages]);
    }
    public function destroy($id)
    {
        $order = $this->restaurantOrderRepository->find($id);
        $order->delete();
        $messages = ['success' => "deletedSuccessfully", 'redirect' => route('restaurantOrders.index')];
        return response()->json(['messages' => $messages]);
    }
    public function restaurantOrderPendding(RestaurantOrdersDataTable $dataTable ,$status){
        return $dataTable->render('admin.orders.restaurant.index');
    }


}
