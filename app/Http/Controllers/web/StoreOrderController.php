<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AddressRepository;
use App\Repositories\CartRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;

class StoreOrderController extends Controller
{
    protected $addressRepository, $cartRepository, $orderItemRepository, $orderRepository;
    public function __construct( AddressRepository $addressRepository, CartRepository $cartRepository, OrderItemRepository $orderItemRepository, OrderRepository $orderRepository)
    {
        $this->addressRepository = $addressRepository;
        $this->cartRepository = $cartRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->orderRepository = $orderRepository;
    }
    public function saveOrder(Request $request){

        $carts = $this->cartRepository->getCart();
        //store address
        $address = $this->addressRepository->createAddress($request->all());
        //store order
        $total_price = $carts->sum('price') + 10 + 10;
        $order = $this->orderRepository->createOrder($request,$address->id,$carts->sum('price'),$total_price);
        //store order details
        foreach($carts as $cart){
            $this->orderItemRepository->createOrderItem($order->id,$cart->product_id,$cart->quantity,$cart->price,$cart->specification);
        }
               //delete cart
        $this->cartRepository->deleteCart();

        /**
         * my fatourah
         */

//$price = 0;
//        foreach ($carts as $cart) {
//            $invoiceItems[] = [
//                'ItemName'  => $cart->product->name, //ISBAN, or SKU
//                'Quantity'  => $cart->quantity, //Item's quantity
//                'UnitPrice' => $cart->price, //Price per item
//            ];
//           $price += $cart->quantity * $cart->price;
//        }

            //payment
//            $json = [
//                'number' => $order->id,
//                'CustomerName' => auth()->user()->name,
//                'NotificationOption' => 'all',
//                'MobileCountryCode' => '+966',
//                'CustomerMobile' => auth()->user()->phone,
//                'DisplayCurrencyIso' => 'SAR',
//                'CustomerEmail' => auth()->user()->email,
//                'InvoiceValue' => $price,
//                "InvoiceItems"=> $invoiceItems,
//                'CallBackUrl' => 'https://dev15.toplinedev.com/diefit/public/success?order_id='.$order->id,
//                'ErrorUrl' =>'https://dev15.toplinedev.com/diefit/public/error?order_id='.$order->id,
//
//            ];



//            $curl = curl_init();
//            curl_setopt_array($curl, array(
//                CURLOPT_URL => "https://api-sa.myfatoorah.com/v2/SendPayment",
//                CURLOPT_CUSTOMREQUEST => "POST",
//                CURLOPT_POSTFIELDS => json_encode($json),
//                CURLOPT_HTTPHEADER => array("Authorization:Bearer xjfV1TFjmUr2vGoaP5J1ja0JpqvaR3t9bZJzAj9aMzfFgzj4IWQlkgaV13fbcWrrctGZge4RxCZuc8Dkp3_rZfDULww7IE3DvUH4kXdaGFThKn7cT-kTmuXre_XhgqMCt6iMMTiC5Kr1kuRXEK52xYgjCQshbAEll1k2AQT5RgZkSKHaqnKB2cHlDZvWFv8CAhvWVlxCW47R8RhjLb8S7LcshljQ3sWc5kyprdV5IiP-Gc3t3fBvnase03p2ekiNHePRiUBb3ckqnPZSSp5hTAgVMMnPNwcjGF-plmmsp_3XDfbm5cCWlOE3tn4Pj_oXAP5Ytqmk8iHPcM2vHblkYy0qQ-hTdogEILUI-7HZmcTEFi7wM_QES9oAUo8eLvGzHRRwV8cNl-HT3noEsZ3-JNDaYFahIjSiIjvwrVztWaUnpjZjcFOY_0S9ZFuinKB0o7t-Myh3d-O4OPZ7vI7STBta6sbVCnbP_GF28vl_OA2MQqXTt-uIaoHo2KYWfHzhj25fEB6yOuNq86ECNFoRxQilIcS00XdpnfI0RqSj_ESV1xt64cFCZvkRSbdGX_cK16yqYEn6CtY8N2tAhCRWzmM9jTdvKnw0x3mi73I7VJO-9RGYTC9SXSJEWsPvDHxteiYnOC486LgJEgOCSXoYhXJurDnk_x73X-jFw241DD-YxCbI-1DT2OuINjrhF1sD77nscry-TlOrQKwf4WASz13J-oP5ay4cSwusC0-mCcVr1d74","Content-Type: application/json"),
//
//            ));



//
//            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//            $response  = json_decode(curl_exec($curl),true);
//            $err = curl_error($curl);
//            curl_close($curl);
//
//
//            if(isset($response['IsSuccess']) && $response['IsSuccess'] == true) {
//                    //delete cart
//                $this->cartRepository->deleteCart();
//                return redirect($response['Data']['InvoiceURL']);
//
//            }else{
//                return redirect(env('myfatoorah.error_url'));
//            }

        return redirect('store/orders');
    }

    public function orders(){
        $orders = $this->orderRepository->getOrders();
        return view('web.stores.orders',compact('orders'));
    }

    public function compelete_orders(){
        $orders = $this->orderRepository->getCompeleteOrders();
        return view('web.stores.orders',compact('orders'));
    }

    public function orderDetails($id){
        $order = $this->orderRepository->find($id);
        $order_items = $this->orderItemRepository->getOrderItemByOrderId($id);
        return view('web.stores.order_details',compact('order','order_items'));
    }

    public function deleteOrder($id){
        $this->orderRepository->delete($id);
        return redirect('store/orders');
    }


}
