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

class DashboardController extends AppBaseController
{

    public function index()
    {

        return view('admin.dashboard');
    }






}
