<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;

/**
 * Class OrderRepository
 * @package App\Repositories
 * @version August 3, 2022, 10:42 pm UTC
*/

class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Order::class;
    }

    /**
     * create order
     */
    public function createOrder($input,$address_id,$price,$total_price,$total)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'address_id' => $address_id,
            'status_id' => '1',
            'total_price' => $total_price,
            'price' => $price,
            'delivery' => 0,
            'tax' => (15* ($total+ 0)  / 100),
            'delivery_date' => $input['date'],
            'delivery_time' => $input['time'],
            'payment' => $input['payment'],
           'payment_status' => 'not_paid',

        ];
        $order = $this->create($data);
        return $order;
    }

    /**
     * getOrders
     */
    public function getOrders()
    {
        $orders = Order::where('user_id', auth()->user()->id)->get();
        return $orders;
    }
    /**
     * getCompeleteOrders
     */
    public function getCompeleteOrders(){
        $orders = Order::where('user_id', auth()->user()->id)->where('status_id', 5)->get();
        return $orders;
    }


}
