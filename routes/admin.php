<?php
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\Food\FoodCategoryController;
use App\Http\Controllers\Admin\Food\FoodController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\DashboardController;
use \App\Http\Controllers\Admin\Article\ArticleController;
use \App\Http\Controllers\Admin\Article\ArticleCategoryController;
use \App\Http\Controllers\Admin\Video\VideoController;
use \App\Http\Controllers\Admin\Video\VideoCategoryController;
use \App\Http\Controllers\Admin\Setting\BranchController;
use \App\Http\Controllers\Admin\Setting\SliderController;
use \App\Http\Controllers\Admin\Setting\TeamMemberController;
use \App\Http\Controllers\Admin\Setting\ClientReviewController;
use \App\Http\Controllers\Admin\Food\ExtraController;
use \App\Http\Controllers\Admin\Subscription\SubscriptionController;
use \App\Http\Controllers\Admin\Subscription\TypeController;
use \App\Http\Controllers\Admin\Food\FoodTypeController;
use \App\Http\Controllers\Admin\Food\WeekFoodController;
use \App\Http\Controllers\Admin\Product\ProductCategoryController;
use \App\Http\Controllers\Admin\Product\ProductController;
use \App\Http\Controllers\Admin\Product\ProductSpecificationController;
use \App\Http\Controllers\Admin\Product\ProductSpecificationCategoryController;
use \App\Http\Controllers\Admin\BankAccountsController;
use \App\Http\Controllers\Admin\StatusController;
use \App\Http\Controllers\Admin\Order\StoreOrderController;
use \App\Http\Controllers\Admin\Order\RestaurantOrderController;
use \App\Http\Controllers\Admin\Order\SubscriptionOrderController;


Route::get('login', [UserController::class, 'login'])->name('admin.login');
Route::post('login', [UserController::class, 'postLogin'])->name('admin.postLogin');

Route::get('logout', [UserController::class, 'logout'])->middleware('auth');

Route::group(['middleware' => ['adminAuth']], function() {

    Route::resource('types', TypeController::class);
    Route::post('types/bulk-delete', [TypeController::class, 'bulkDelete'])->name('types.bulk-delete');

    Route::resource('subscriptions', SubscriptionController::class);
    Route::post('subscriptions/bulk-delete', [SubscriptionController::class, 'bulkDelete'])->name('subscriptions.bulk-delete');


    Route::resource('branches', BranchController::class);
    Route::post('branches/bulk-delete', [BranchController::class, 'bulkDelete'])->name('branches.bulk-delete');

    Route::resource('sliders', SliderController::class);
    Route::post('sliders/bulk-delete', [SliderController::class, 'bulkDelete'])->name('sliders.bulk-delete');

    Route::resource('teamMembers', TeamMemberController::class);
    Route::post('teamMembers/bulk-delete', [TeamMemberController::class, 'bulkDelete'])->name('teamMembers.bulk-delete');

    Route::resource('clientReviews', ClientReviewController::class);
    Route::post('clientReviews/bulk-delete', [ClientReviewController::class, 'bulkDelete'])->name('clientReviews.bulk-delete');

    Route::resource('foodCategories', FoodCategoryController::class);
    Route::post('foodCategories/bulk-delete', [FoodCategoryController::class, 'bulkDelete'])->name('foodCategories.bulk-delete');

    Route::resource('foods', FoodController::class);
    Route::post('foods/bulk-delete', [FoodController::class, 'bulkDelete'])->name('foods.bulk-delete');

    Route::resource('foodTypes', FoodTypeController::class);
    Route::post('foodTypes/bulk-delete', [FoodTypeController::class, 'bulkDelete'])->name('foodTypes.bulk-delete');

    Route::resource('extras', ExtraController::class);
    Route::post('extras/bulk-delete', [ExtraController::class, 'bulkDelete'])->name('extras.bulk-delete');

    Route::resource('article_categories', ArticleCategoryController::class);
    Route::post('article_categories/bulk-delete', [ArticleCategoryController::class, 'bulkDelete'])->name('article_categories.bulk-delete');

    Route::resource('articles', ArticleController::class);
    Route::post('articles/bulk-delete', [ArticleController::class, 'bulkDelete'])->name('articles.bulk-delete');


    Route::resource('video_categories', VideoCategoryController::class);
    Route::post('video_categories/bulk-delete', [VideoCategoryController::class, 'bulkDelete'])->name('video_categories.bulk-delete');

    Route::resource('videos', VideoController::class);
    Route::post('videos/bulk-delete', [VideoController::class, 'bulkDelete'])->name('videos.bulk-delete');



    Route::resource('dashboard', DashboardController::class);

    Route::resource('areas', AreaController::class);
    Route::post('areas/bulk-delete', [AreaController::class, 'bulkDelete'])->name('areas.bulk-delete');


    Route::resource('cities', CityController::class);
    Route::post('cities/bulk-delete', [CityController::class, 'bulkDelete'])->name('cities.bulk-delete');
    Route::get('cities/cityAjax/{area_id}', [CityController::class, 'cityAjax'])->name('cities.cityAjax');

    Route::resource('districts', DistrictController::class);
    Route::post('districts/bulk-delete', [DistrictController::class, 'bulkDelete'])->name('districts.bulk-delete');
    Route::get('districts/districtAjax/{area_id}', [DistrictController::class, 'districtAjax'])->name('districts.cityAjax');




    Route::resource('pages', PageController::class);
    Route::post('pages/bulk-delete', [PageController::class, 'bulkDelete'])->name('pages.bulk-delete');


    Route::resource('settings', SettingController::class);
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings/{setting_group}', [SettingController::class, 'update'])->name('settings.update');


    Route::resource('users', UserController::class);
    Route::post('users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulk-delete');
    Route::get('users/mySubscription/{id}', [UserController::class, 'mySubscription'])->name('users.mySubscription');

    Route::resource('products', ProductController::class);
    Route::post('products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulk-delete');

    Route::resource('productCategories', productCategoryController::class);
    Route::post('productCategories/bulk-delete', [productCategoryController::class, 'bulkDelete'])->name('productCategories.bulk-delete');


    Route::resource('ProductSpecificationCategory', ProductSpecificationCategoryController::class);
    Route::post('ProductSpecificationCategory/bulk-delete', [ProductSpecificationCategoryController::class, 'bulkDelete'])->name('ProductSpecificationCategory.bulk-delete');

    Route::resource('ProductSpecification', ProductSpecificationController::class);
    Route::post('ProductSpecification/bulk-delete', [ProductSpecificationController::class, 'bulkDelete'])->name('ProductSpecification.bulk-delete');



    Route::resource('roles', RoleController::class);
    Route::resource('status', StatusController::class);

    Route::resource('weekFoods', WeekFoodController::class);

    Route::resource('storeOrders', StoreOrderController::class);
    Route::post('storeOrders/bulk-delete', [StoreOrderController::class, 'bulkDelete'])->name('storeOrders.bulk-delete');
    Route::get('storeOrderPendding/{status}', [StoreOrderController::class, 'storeOrderPendding']);

    Route::resource('restaurantOrders', RestaurantOrderController::class);
    Route::post('restaurantOrders/bulk-delete', [RestaurantOrderController::class, 'bulkDelete'])->name('restaurantOrders.bulk-delete');
    Route::get('restaurantOrderPendding/{status}', [RestaurantOrderController::class, 'restaurantOrderPendding']);

    Route::resource('subscriptionOrders', SubscriptionOrderController::class);
    Route::get('subscriptionOrders/sendnotify/{id}', [SubscriptionOrderController::class ,'sendNotification']);
    Route::post('subscriptionOrders/bulk-delete', [SubscriptionOrderController::class, 'bulkDelete'])->name('subscriptionOrders.bulk-delete');
    Route::get('subscriptionOrderPendding/{status}', [SubscriptionOrderController::class, 'subscriptionOrderPendding']);

    Route::resource('bankAccounts', BankAccountsController::class);
    Route::post('bankAccounts/bulk-delete', [BankAccountsController::class, 'bulkDelete'])->name('bankAccounts.bulk-delete');

});

