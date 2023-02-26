<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\web\UserController;
use \App\Http\Controllers\web\ArticleController;
use \App\Http\Controllers\web\VideoController;
use \App\Http\Controllers\web\HomeController;
use \App\Http\Controllers\web\StoreController;
use \App\Http\Controllers\web\StoreOrderController;
use \App\Http\Controllers\web\SubscriptionController;
use \App\Http\Controllers\web\RestaurantController;
use \App\Http\Controllers\web\RestaurantOrderController;
use \App\Http\Controllers\web\FavouriteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * User routes
 */

Route::get('/test',function(){
 // \Artisan::call('config:cache');
// $ff = sendSMS('test','966557831365');
 // dd($ff);

});
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function() {
    /**
     * User routes
     */
    Route::get('register', [UserController::class, 'register'])->middleware('guest');
    Route::post('postRegister', [UserController::class, 'postRegister']);

    Route::get('code/{user_id}/{type?}', [UserController::class, 'code']);
    Route::post('postCode', [UserController::class, 'postCode']);

    Route::get('login', [UserController::class, 'login'])->name('login')->middleware('guest');
    Route::post('postLogin', [UserController::class, 'postLogin']);

    Route::get('logout', [UserController::class, 'logout']);



    Route::get('forgetPassword', [UserController::class, 'showForgetPasswordForm']);
    Route::post('forgetPassword', [UserController::class, 'submitForgetPasswordForm']);
    Route::get('resetPassword/{user_id}', [UserController::class, 'showResetPasswordForm']);
    Route::post('resetPassword', [UserController::class, 'submitResetPasswordForm']);


    /**
     * Route for home page
     */

    Route::get('/', [HomeController::class, 'home']);

    Route::get('contact', [HomeController::class, 'contact']);
    Route::post('contact', [HomeController::class, 'post_contact']);

    Route::group(['middleware'=>'auth'],function(){

        Route::get('profile', [UserController::class, 'profile']);
        Route::get('additionalData', [UserController::class, 'additionalData']);
        Route::post('updateAdditionalData', [UserController::class, 'updateAdditionalData']);

        /**
         * Route for article
         */

        Route::get('articleCategories', [ArticleController::class, 'articleCategories']);
        Route::get('articles/{category_id}', [ArticleController::class, 'articles']);
        Route::get('article/{id}', [ArticleController::class, 'article']);
        Route::post('commentStore', [ArticleController::class, 'commentStore'])->name('comments.store');
        Route::post('addFavorite', [ArticleController::class, 'addFavorite']);

        /**
         * Route for video
         */

        Route::get('videos', [VideoController::class, 'videos']);
        Route::group( ['prefix' => 'video'], function () {
            Route::get('/{id}', [VideoController::class, 'video']);
            Route::post('/comment', [VideoController::class, 'videoCommentStore'])->name('videocomments.store');
            Route::post('/addFavorite', [VideoController::class, 'videoAddFavorite']);
        });

        /**
         * Route for Store
         */

        Route::get('storeProducts/{product_category_id}', [StoreController::class, 'storeProducts']);
        Route::get('productDetails/{product_id}', [StoreController::class, 'productDetails']);

        Route::group( ['prefix' => 'store'], function () {
            Route::get('/', [StoreController::class, 'store']);
            Route::post('/addFavorite', [StoreController::class, 'addFavorite']);

            Route::get('/getFavorite', [StoreController::class, 'getFavorite']);
            Route::post('/addCart', [StoreController::class, 'addCart']);
            Route::get('/cart', [StoreController::class, 'cart']);
            Route::get('/removeCart/{id}', [StoreController::class, 'removeCart']);
            Route::get('/checkOut', [StoreController::class, 'checkOut']);
            Route::post('/save/order', [StoreOrderController::class, 'saveOrder']);
            Route::get('/orders', [StoreOrderController::class, 'orders']);
            Route::get('/compelete/orders', [StoreOrderController::class, 'compelete_orders']);
            Route::get('/deleteOrder/{order_id}', [StoreOrderController::class, 'deleteOrder']);
            Route::get('/orderDetails/{id}', [StoreOrderController::class, 'orderDetails']);
            Route::get('/success', [StoreOrderController::class, 'successPayment']);
            Route::get('/error', [StoreOrderController::class, 'errorPayment']);
        });
        /**
         * Route for subscription
         */

        Route::group( ['prefix' => 'subscriptions'], function () {
            Route::get('/', [SubscriptionController::class, 'subscriptions']);
            Route::get('/create/{subscriptionId}/{subscriptionOrderId}', [SubscriptionController::class, 'subscriptionCreate']);
            Route::post('/store', [SubscriptionController::class, 'subscriptionStore']);
            Route::get('/subscriptionOrder', [SubscriptionController::class, 'subscriptionOrder']);
            Route::get('/orderFood/{subscriptionId}/{subscripionOrderId}', [SubscriptionController::class, 'subscriptionOrderFood']);
            Route::post('/saveOrderFood', [SubscriptionController::class, 'saveSubscriptionOrderFood']);
        });

        Route::group( ['prefix' => 'restaurant'], function () {
            Route::get('/' , [RestaurantController::class ,'index']);
            Route::get('foods/{category_id}' , [RestaurantController::class ,'foods']);
            Route::get('foodDetails/{food_id}' , [RestaurantController::class ,'foodDetails']);
            Route::post('/addFavorite', [RestaurantController::class, 'addFavorite']);

            Route::get('/getFavorite', [RestaurantController::class, 'getFavorite']);
           	Route::get('/removeFavorite/{food_id}', [RestaurantController::class, 'removeFavorite']);
            Route::post('/addCart', [RestaurantController::class, 'addCart']);
            Route::get('/cart', [RestaurantController::class, 'cart']);
            Route::get('/removeCart/{id}', [RestaurantController::class, 'removeCart']);
            Route::get('/checkOut', [RestaurantController::class, 'checkOut']);
            Route::post('/save/order', [RestaurantOrderController::class, 'saveOrder']);
            Route::get('/orders', [RestaurantOrderController::class, 'orders']);
            Route::get('/compelete/orders', [RestaurantOrderController::class, 'compelete_orders']);
            Route::get('/deleteOrder/{order_id}', [RestaurantOrderController::class, 'deleteOrder']);
            Route::get('/orderDetails/{id}', [RestaurantOrderController::class, 'orderDetails']);


        });
      /**
      *favourite
      */
                  Route::get('/getFavorite', [FavouriteController::class, 'getFavorite']);
    });
});
