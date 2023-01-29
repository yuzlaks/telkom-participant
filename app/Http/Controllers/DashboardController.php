<?php

namespace App\Http\Controllers;

use App\Models\PosModel;
use App\Models\UserPicModel;
use App\Models\UserPosModel;
use App\Models\UserRegionalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DashboardController extends Controller
{
    public function index()
    {
        $role = "";

        $userregional = UserRegionalModel::count();
        $userpic      = UserPicModel::count();
        $userpos      = UserPosModel::count();
        $pos          = PosModel::count();
    
        $dataUser = "";

        if (!empty(Auth::guard('user_regionals')->user()->id)) {
            $dataUser = UserRegionalModel::where('id', Auth::guard('user_regionals')->user()->id)->first();
            $role = "regional";
        }

        if (!empty(Auth::guard('user_pic')->user()->id)) {
            $dataUser = UserPicModel::where('id', Auth::guard('user_pic')->user()->id)->first();
            $role = "pic";
        }
        
        if (!empty(Auth::guard('user_pos')->user()->id)) {
            $dataUser = UserPosModel::where('id', Auth::guard('user_pos')->user()->id)->first();
            $role = "pos";
        }

        return view('dashboard', compact('userregional','userpic','userpos','pos','dataUser','role'));
    }

    public function printBarcode($type, $id)
    {

        $url = "";
        $nama = "";

        if ($type == "user-pos") {
            $userpos = UserPosModel::where('id', $id)->first();
            $url = $userpos->url;
            $nama = $userpos->nama;
        }
        
        if ($type == "user-pic") {
            $userpic = UserPicModel::where('id', $id)->first();
            $nama = $userpos->name;
            $url = $userpic->url;
        }

        $barcode = QrCode::size(400)->generate(url($url));

        $pdf = PDF::loadview('cetak-barcode/index', compact('barcode','url', 'nama'));
    	return $pdf->download('cetak-barcode.pdf');
    }
}
