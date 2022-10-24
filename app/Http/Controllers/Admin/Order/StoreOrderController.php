<?php
namespace App\Http\Controllers\Admin\Order;


use App\Http\Controllers\AppBaseController;
use App\DataTables\StoreOrdersDataTable;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Repositories\StatusRepository;
use Illuminate\Http\Request;

class StoreOrderController  extends AppBaseController
{
    private $orderRepository , $statusRepository;
    public function __construct(OrderRepository $orderRepository , StatusRepository $statusRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->statusRepository = $statusRepository;
    }


    public function index( StoreOrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.orders.store.index');
    }

    public function show($id)
    {
        $order = $this->orderRepository->find($id);
        return view('admin.orders.store.show', compact('order'));
    }

    public function edit($id)
    {
        $order = $this->orderRepository->find($id);
        $statuses = $this->statusRepository->all();
        return view('admin.orders.store.edit', compact('order', 'statuses'));
    }
    public function update(Request $request, $id)
    {
        $order = $this->orderRepository->find($id);
        $order->status_id = $request->status;
        $order->save();
        $messages = ['success' => "updatedSuccessfully", 'redirect' => route('storeOrders.index')];
        return response()->json(['messages' => $messages]);
    }
    public function destroy($id)
    {
        $order = $this->orderRepository->find($id);
        $order->delete();
        $messages = ['success' => "deletedSuccessfully", 'redirect' => route('storeOrders.index')];
        return response()->json(['messages' => $messages]);
    }

    public function storeOrderPendding(StoreOrdersDataTable $dataTable ,$status){
        return $dataTable->render('admin.orders.store.index');
    }


}
