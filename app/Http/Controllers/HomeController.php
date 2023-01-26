<?php

namespace App\Http\Controllers;

use App\Models\UserPicModel;
use App\Models\UserPosModel;
use Illuminate\Http\Request;
Use Alert;
use App\Models\PosModel;

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
            'kecamatan'   => 'required',
            'kabupaten'   => 'required',
            'tgl_order'   => 'required',
            'pos_id'      => 'required'
        ]);
           
        $data = $request->all();
        $check = $this->saveDataCustomer($data);
        
        if (!empty($request->from_frontend)) {
            Alert::success('Success Title', 'Terima kasih sudah menjadi pelanggan kami.
            Data Anda sudah kami terima. <br><br>
            
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
            "kecamatan"   => $data['kecamatan'],
            "kabupaten"   => $data['kabupaten'],
            "tgl_order"   => $data['tgl_order'],
            "pos_id"      => $data['pos_id'],
            "pos_name"    => $pos->nama
        ]);
    }  
}