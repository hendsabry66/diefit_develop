<?php

namespace App\Repositories;

use App\Models\RestaurantOrderItem;
use App\Repositories\BaseRepository;

/**
 * Class RestaurantOrderItemRepository
 * @package App\Repositories
 * @version August 31, 2022, 10:43 am UTC
*/

class RestaurantOrderItemRepository extends BaseRepository
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
        return RestaurantOrderItem::class;
    }
    /**
     * create order item
     */
    public function createOrderItem($order_id,$food_id,$quantity,$price)
    {
        $data = [
            'order_id' => $order_id,
            'food_id' => $food_id,
            'quantity' => $quantity,
            'price' => $price,

        ];
        $order_item = $this->create($data);
        return $order_item;
    }

    /**
     * get order item by order id
     */
    public function getOrderItemByOrderId($order_id)
    {
        return $this->model->where('order_id',$order_id)->get();
    }
}
