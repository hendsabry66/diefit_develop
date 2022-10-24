<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Repositories\BaseRepository;

/**
 * Class CartRepository
 * @package App\Repositories
 * @version August 3, 2022, 9:42 pm UTC
*/

class CartRepository extends BaseRepository
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
        return Cart::class;
    }

    public function addCart($input)
    {
        $input['specification'] = json_encode($input->except('_token', 'quantity','product_id','price'));
        $data = [
            'user_id' => auth()->user()->id,
            'product_id' => $input['product_id'],
            'quantity' => $input['quantity'],
            'price' => $input['price'],
            'specification' => $input['specification']
        ];

        $cart = $this->create($data);
        return $cart;
    }
    public function getCart()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->get();
        return $carts;
    }
    public function deleteCart()
    {
        return  Cart::where('user_id', auth()->user()->id)->delete();


    }
}
