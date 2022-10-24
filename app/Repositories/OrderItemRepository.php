<?php

namespace App\Repositories;

use App\Models\OrderItem;
use App\Repositories\BaseRepository;

/**
 * Class OrderItemRepository
 * @package App\Repositories
 * @version August 3, 2022, 10:43 pm UTC
*/

class OrderItemRepository extends BaseRepository
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
        return OrderItem::class;
    }

    /**
     * create order item
     */
    public function createOrderItem($order_id,$product_id,$quantity,$price,$specification)
    {
        $data = [
            'order_id' => $order_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price,
            'specification' => $specification,
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
