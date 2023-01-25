<?php

namespace App\Http\Controllers;

use App\Models\UserPicModel;
use App\Models\UserPosModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function createUserPos($referal_pic)
    {
        $pic = UserPicModel::where('id', $referal_pic)->first();
        return view('home/create-user-pos', compact('pic'));
    }

    public function createUserCustomer($referal_pos)
    {
        $pos = UserPosModel::where('id', $referal_pos)->first();
        $pic = UserPicModel::where('id', $pos->pic_id)->first();
        return view('home/create-user-customer', compact('pos','pic'));
    }
}