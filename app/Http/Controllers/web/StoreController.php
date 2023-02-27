<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\RestaurantCart;
use Illuminate\Http\Request;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CartRepository;
use App\Repositories\CityRepository;

class StoreController extends Controller
{
    protected $productCategoryRepository, $productRepository, $cartRepository ,$cityRepository;
    public function __construct( ProductCategoryRepository $productCategoryRepository, ProductRepository $productRepository , CartRepository $cartRepository, CityRepository $cityRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->productRepository = $productRepository;
        $this->cartRepository = $cartRepository;
        $this->cityRepository = $cityRepository;
    }



    public function store()
    {
        $products = \App\Models\Product::withCount('orders')->orderByDesc('orders_count')->take(10)->get();
        $productCategories = $this->productCategoryRepository->all();

        return view('web.stores.store', compact('productCategories','products'));
    }

    public function storeProducts($id)
    {
        $productCategory = $this->productCategoryRepository->find($id);
        $products = $this->productRepository->getProductsByCategory($id);
        return view('web.stores.store_products', compact( 'products', 'productCategory'));
    }
    public function productDetails($id)
    {
        $product = $this->productRepository->find($id);
        if(auth()->check())
        {
            $isFavorite = $product->favourites()->where('user_id', auth()->user()->id)->exists();
        }
        else
        {
            $isFavorite = false;
        }
        //$isFavorite = $product->favourites()->where('user_id', auth()->user()->id)->exists();
        $similarProducts = $this->productRepository->getSimilarProducts($product->productCategory->id);
        return view('web.stores.product_details', compact('product', 'similarProducts', 'isFavorite'));
    }
    public function addFavorite(Request $request)
    {

         $product = $this->productRepository->find($request->product_id);
        $product->favourites()->create([
            'user_id' => auth()->user()->id,
        ]);
        return response()->json(['success'=>'Added to favorite list']);
    }
    public function getFavorite()
    {
         $products = $this->productRepository->getFavoriteProducts(auth()->user()->id);
        return view('web.stores.favourite', compact('products'));
    }

    public function removeFavorite(Request $request)
    {
        $product = $this->productRepository->find($request->product_id);
        $product->favourites()->where('user_id', auth()->user()->id)->delete();
        return response()->json(['success'=>'Removed from favorite list']);
    }

    public function checkFavorite($product_id)
    {
        $product = $this->productRepository->find($product_id);
        $isFavorite = $product->favourites()->where('user_id', auth()->user()->id)->exists();
        return response()->json(['isFavorite'=>$isFavorite]);
    }

    public function addCart(Request $request)
    {
        $restaurantCart = RestaurantCart::where('user_id',auth()->user()->id)->count();
        if($restaurantCart != 0){
            return redirect()->back()->with('error', __('web.you_cannot_add_products_and_the_basket_contains_meals'));
        }
        $carts= $this->cartRepository->getCart()->pluck('product_id')->toArray();
        if(in_array($request->product_id,$carts)){
            Cart::where('user_id',auth()->user()->id)->where('product_id',$request->product_id)->increment('quantity');
        }else{
            $cart = $this->cartRepository->addCart($request);
        }

        return redirect()->back()->with('success', __('web.Added to cart successfully'));
    }
    public function cart()
    {
        $carts = $this->cartRepository->getCart();
        return view('web.stores.cart', compact('carts'));
    }
    public function removeCart($id)
    {
        $cart = $this->cartRepository->find($id);
        $cart->delete();
        return "true";
        //return redirect()->back()->with('success', __('web.Removed from cart successfully'));
    }
    public function checkOut(){
        $carts = $this->cartRepository->getCart();
        $cities = $this->cityRepository->all();
        return view('web.stores.checkout', compact('carts', 'cities'));
    }

}
