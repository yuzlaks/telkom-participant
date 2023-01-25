<?php

namespace App\Http\Controllers;

use App\Models\PosModel;
use App\Models\UserPicModel;
use App\Models\UserPosModel;
use App\Models\UserRegionalModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userregional = UserRegionalModel::count();
        $userpic      = UserPicModel::count();
        $userpos      = UserPosModel::count();
        $pos          = PosModel::count();

        return view('dashboard', compact('userregional','userpic','userpos','pos'));
    }
}
