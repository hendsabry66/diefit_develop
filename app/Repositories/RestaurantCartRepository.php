<?php

namespace App\Repositories;

use App\Models\RestaurantCart;
use App\Repositories\BaseRepository;

/**
 * Class RestaurantCartRepository
 * @package App\Repositories
 * @version August 30, 2022, 11:17 am UTC
*/

class RestaurantCartRepository extends BaseRepository
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
        return RestaurantCart::class;
    }
    public function addCart($input)
    {
       $data = [
            'user_id' => auth()->user()->id,
            'food_id' => $input['food_id'],
            'quantity' => $input['quantity'],
            'price' => $input['price'],
        ];

        $cart = $this->create($data);
        return $cart;
    }
    public function getCart()
    {
        $carts = RestaurantCart::where('user_id', auth()->user()->id)->get();
        return $carts;
    }
    public function deleteCart()
    {
        return  RestaurantCart::where('user_id', auth()->user()->id)->delete();


    }
}
