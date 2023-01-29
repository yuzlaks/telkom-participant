<?php

namespace App\Http\Controllers;

use App\Models\PosModel;
use App\Models\UserPicModel;
use App\Models\UserPosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PosModel::paginate(10);
        $role = Auth::guard('user_regionals')->user()->id ?? 0;
        return view('pos/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pos = UserPosModel::all();
        return view('pos/create', compact('pos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            'pos_id'      => 'required'
        ]);
           
        $data = $request->all();
        $check = $this->saveData($data);
        
        if (!empty($request->from_frontend)) {
            return redirect()->back()->withErrors(['msg' => 'Simpan Berhasil!']);
        }else{
            return redirect("pos")->withErrors(['msg' => 'Berhasil Tambah Data!']);
        }

    }

    public function saveData(array $data)
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
            "tgl_order"   => date('Y-m-d'),
            "pos_id"      => $data['pos_id'],
            "pos_name"    => $pos->nama
        ]);
    }  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PosModel::where('id',$id)->first();
        return view('pos/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pos = UserPosModel::all();
        $data = PosModel::where('id',$id)->first();
        return view('pos/edit', compact('data', 'pos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pos = UserPosModel::where('id', $request->pos_id)->first();

        PosModel::where('id',$id)->update([
            "regional"    => $request->regional,
            "witel"       => $request->witel,
            "datel"       => $request->datel,
            "order_name"  => $request->order_name,
            "order_email" => $request->order_email,
            "notel"       => $request->notel,
            "alamat"      => $request->alamat,
            "kecamatan"   => $request->kecamatan,
            "kabupaten"   => $request->kabupaten,
            "tgl_order"   => $request->tgl_order,
            "pos_id"      => $request->pos_id,
            "pos_name"    => $pos->nama
        ]);

        return redirect("pos")->withErrors(['msg' => 'Berhasil Update Data!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PosModel::where('id',$id)->delete();
        return redirect("pos")->withErrors(['msg' => 'Berhasil Hapus Data!']);
    }

    public function getRegional($pos_id)
    {
        $pos = UserPosModel::where('id', $pos_id)->first();
        $pic = UserPicModel::where('id', $pos->pic_id)->first();
        // echo $pic->regional;

        return response()->json($pic);

    }
}
