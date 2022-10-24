<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\RestaurantCart;
use Illuminate\Http\Request;
use App\Repositories\FoodCategoryRepository;
use App\Repositories\FoodRepository;
use App\Repositories\RestaurantCartRepository;
use App\Repositories\CityRepository;


class RestaurantController extends Controller
{
    protected $foodCategoryRepository , $foodRepository , $restaurantCartRepository , $cityRepository;
    public function __construct( FoodCategoryRepository $foodCategoryRepository , FoodRepository $foodRepository , RestaurantCartRepository $restaurantCartRepository , CityRepository $cityRepository )
    {
        $this->foodCategoryRepository = $foodCategoryRepository;
        $this->foodRepository = $foodRepository;
        $this->restaurantCartRepository = $restaurantCartRepository;
        $this->cityRepository = $cityRepository;
    }


    public function index()
    {
        $foodCategories = $this->foodCategoryRepository->all();
        $bestFoods = $this->foodRepository->all();
        return view('web.restaurants.index', compact('foodCategories', 'bestFoods'));
    }
    public function foods($category_id)
    {
        $category = $this->foodCategoryRepository->find($category_id);
        $foods = $this->foodRepository->allQuery(['category_id'=>$category_id])->get();
        return view('web.restaurants.foods', compact('foods','category'));
    }
    public function foodDetails($food_id)
    {
        $food = $this->foodRepository->find($food_id);
        $isFavorite = $food->favourites()->where('user_id', auth()->user()->id)->exists();
        $similarFoods = $this->foodRepository->allQuery(['category_id'=>$food->category_id])->get();
        return view('web.restaurants.foodDetails', compact('food','similarFoods','isFavorite'));
    }

    public function addFavorite(Request $request)
    {

         $food = $this->foodRepository->find($request->food_id);
        $food->favourites()->create([
            'user_id' => auth()->user()->id,
        ]);
        return response()->json(['success'=>'Added to favorite list']);
    }

    public function getFavorite(){
        $foods = $this->foodRepository->getFavoriteProducts(auth()->user()->id);
        return view('web.restaurants.favourite', compact('foods'));
    }
    public function removeFavorite($food_id)
    {

        $food = $this->foodRepository->find($food_id);
        $food->favourites()->where('user_id', auth()->user()->id)->delete();
        return response()->json(['success'=>'Removed from favorite list']);
    }
    public function checkFavorite($food_id)
    {
        $food = $this->foodRepository->find($food_id);
        $isFavorite = $food->favourites()->where('user_id', auth()->user()->id)->exists();
        return response()->json(['isFavorite'=>$isFavorite]);
    }


    public function addCart(Request $request)
    {
        $storeCart = Cart::where('user_id',auth()->user()->id)->count();
        if($storeCart != 0){
            return redirect()->back()->with('error', 'لا يمكنك اضافة وجبات والسلة يوجد بها منتجات ');
        }
         $carts= $this->restaurantCartRepository->getCart()->pluck('food_id')->toArray();

        if(in_array($request->food_id,$carts)){
            RestaurantCart::where('user_id',auth()->user()->id)->where('food_id',$request->food_id)->increment('quantity');
        }else{
            $cart = $this->restaurantCartRepository->addCart($request);
        }

        return redirect()->back()->with('success', __('web.food_added_to_cart'));
    }

    public function cart()
    {
        $carts = $this->restaurantCartRepository->getCart();
        return view('web.restaurants.cart', compact('carts'));
    }
    public function removeCart($id)
    {
        $cart = $this->restaurantCartRepository->find($id);
        $cart->delete();
        return "true";
        //return redirect()->back()->with('success', 'food removed from cart');
    }

        public function checkOut(){
        $carts = $this->restaurantCartRepository->getCart();
        $cities = $this->cityRepository->all();
        return view('web.restaurants.checkout', compact('carts', 'cities'));
    }




}
