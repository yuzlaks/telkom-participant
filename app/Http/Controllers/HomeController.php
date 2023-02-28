<?php

namespace App\Http\Controllers;

use App\Models\UserPicModel;
use App\Models\UserPosModel;
use Illuminate\Http\Request;
Use Alert;
use App\Models\PosModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

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

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'regional'    => 'required',
            'witel'       => 'required',
            'datel'       => 'required',
            'order_name'  => 'required',
            'order_email' => 'required',
            'notel'       => 'required',
            'alamat'      => 'required',
            'provinsi'    => 'required',
            'kabupaten'   => 'required',
            'kecamatan'   => 'required',
            'kelurahan'   => 'required',
            'pos_id'      => 'required'
        ]);
           
        $data = $request->all();
        $check = $this->saveDataCustomer($data);
        
        if (!empty($request->from_frontend)) {
            Alert::success('Success Title', 'Terima kasih sudah menjadi pelanggan kami.
            Data Anda sudah kami terima.
            
            Mohon ditunggu, pihak kami akan segera
            menghubungi Anda secepat mungkin.');
            return redirect()->back()->withErrors(['msg' => 'Simpan Berhasil!']);
        }else{
            return redirect("pos")->withErrors(['msg' => 'Berhasil Tambah Data!']);
        }

    }

    public function saveDataCustomer(array $data)
    {
        $pos = UserPosModel::where('id', $data['pos_id'])->first();

        PosModel::create([
            "regional"    => $data['regional'],
            "witel"       => $data['witel'],
            "datel"       => $data['datel'],
            "order_name"  => $data['order_name'],
            "order_email" => $data['order_email'],
            "notel"       => $data['notel'],
            "alamat"      => $data['alamat'],
            'provinsi'    => $data['provinsi'],
            'kabupaten'   => $data['kabupaten'],
            'kecamatan'   => $data['kecamatan'],
            'kelurahan'   => $data['kelurahan'],
            "tgl_order"   => date('Y-m-d'),
            "pos_id"      => $data['pos_id'],
            "pos_name"    => $pos->nama
        ]);
    }  

    public function storeUserPos(Request $request)
    {
        $request->validate([
            'email'     => 'required|email|unique:user_pos',
            'password'  => 'required|min:6',
            'notel'     => 'required',
            'pic_id'    => 'required',
            'alamat'    => 'required',
            'provinsi'    => 'required',
            'kabupaten'   => 'required',
            'kecamatan'   => 'required',
            'kelurahan'   => 'required',
        ]);

        $data = $request->all();

        $check = $this->saveDataUserPos($data);

        if (!empty($request->from_frontend)) {
            return redirect()->back()->withErrors(['msg' => 'Simpan Berhasil!']);
        }else{
            return redirect("user-pos")->withErrors(['msg' => 'Simpan Berhasil!']);
        }
         
    }

    public function saveDataUserPos(array $data)
    {
        $host = URL::to('/');
        $insert = UserPosModel::create([
            'nama'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'notel'     => $data['notel'],
            'pic_id'    => $data['pic_id'],
            'pic_name'  => $data['pic_name'],
            'alamat'    => $data['alamat'],
            'provinsi'  => $data['provinsi'],
            'kabupaten' => $data['kabupaten'],
            'kecamatan' => $data['kecamatan'],
            'kelurahan' => $data['kelurahan'],
            'url'       => ''
        ]);

        $url = 'https://telkomregional5.id/shorturl/insert.php';

        $txt = "url=" . $host . "/create-customer-from-user-pos/" . $insert->id;
        // $txt = "url=https://94c0-36-68-219-139.ap.ngrok.io/create-customer-from-user-pos/" . $insert->id;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $txt);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $a = (array) json_decode($result);
        // after that, update column url
        UserPosModel::where('id', $insert->id)->update([
            'url' => $a["link"]
        ]);

    }  
}