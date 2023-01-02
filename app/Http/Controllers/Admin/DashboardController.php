<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\DataTables\CityDataTable;
use App\Models\Area;
use App\Repositories\CityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Article;
use App\Models\District;
use App\Models\Branch;
use App\Models\Video;
use App\Models\Food;
use App\Models\Product;


class DashboardController extends AppBaseController
{

    public function index()
    {
        $users = User::count();
        $areas = Area::count();
        $cities = City::count();
        $districts = District::count();
        $branches = Branch::count();
        $articles = Article::count();
        $videos = Video::count();
        $foods = Food::count();
        $subscriptions = Subscription::count();
        $products = Product::count();

        return view('admin.dashboard', compact('users', 'areas', 'cities', 'districts', 'branches', 'articles', 'videos', 'foods', 'subscriptions', 'products'));
    }






}
