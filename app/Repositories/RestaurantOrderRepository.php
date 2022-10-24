<?php

namespace App\Repositories;

use App\Models\RestaurantOrder;
use App\Repositories\BaseRepository;

/**
 * Class RestaurantOrderRepository
 * @package App\Repositories
 * @version August 31, 2022, 10:44 am UTC
*/

class RestaurantOrderRepository extends BaseRepository
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
        return RestaurantOrder::class;
    }
    /**
     * create order
     */
    public function createOrder($input,$address_id,$price,$total_price)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'address_id' => $address_id,
            'status_id' => '1',
            'total_price' => $total_price,
            'price' => $price,
            'delivery' => 10,
            'tax' => 10,
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
        $orders = RestaurantOrder::where('user_id', auth()->user()->id)->get();
        return $orders;
    }
    /**
     * getCompeleteOrders
     */
    public function getCompeleteOrders(){
        $orders = RestaurantOrder::where('user_id', auth()->user()->id)->where('status_id', 5)->get();
        return $orders;
    }

}
