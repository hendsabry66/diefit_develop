<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\FoodRepository;
use App\Repositories\ProductRepository;


class FavouriteController extends Controller
{
    private $foodRepository , $productRepository;
    public function __construct( FoodRepository $foodRepository , ProductRepository $productRepository )
    {
        $this->foodRepository = $foodRepository;
        $this->productRepository = $productRepository;
    }



    public function getFavorite(){
        $foods = $this->foodRepository->getFavoriteProducts(auth()->user()->id);
        $products = $this->productRepository->getFavoriteProducts(auth()->user()->id);
        return view('web.favourite.favourite', compact('foods','products'));
    }
}
