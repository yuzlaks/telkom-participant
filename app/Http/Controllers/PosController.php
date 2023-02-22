<?php

namespace App\Http\Controllers;

use App\Models\PosModel;
use App\Models\UserPicModel;
use App\Models\UserPosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // untuk pengecekan apakah dia (login) admin
        $checkRole = Auth::guard('user_regionals')->user()->role ?? 0;

        if (strtoupper($checkRole) == "ADMIN") {
            $data = PosModel::select([
                                        'pos.*',
                                        'provinces.name AS provinsi',
                                        'regencies.name AS kabupaten',
                                        'districts.name AS kecamatan',
                                        'villages.name AS kelurahan',
                                    ])
                                    ->leftjoin('provinces','pos.provinsi','=','provinces.id')
                                    ->leftjoin('regencies','pos.kabupaten','=','regencies.id')
                                    ->leftjoin('districts','pos.kecamatan','=','districts.id')
                                    ->leftjoin('villages','pos.kelurahan','=','villages.id')
                                    ->paginate(10);
        } else {
            $data_regional = Auth::guard('user_regionals')->user()->id ?? 0;

            $data_pic = Auth::guard('user_pic')->user()->id ?? 0;

            $data_pos = UserPosModel::where('pic_id', $data_pic)->get();

            $id = array();
            foreach ($data_pos as $key => $value_user_pos) {
                $id[] = $value_user_pos->id;
            }

            $data = PosModel::select([
                                    'pos.*',
                                    'provinces.name AS provinsi',
                                    'regencies.name AS kabupaten',
                                    'districts.name AS kecamatan',
                                    'villages.name AS kelurahan',
                                ])
                                ->leftjoin('provinces','pos.provinsi','=','provinces.id')
                                ->leftjoin('regencies','pos.kabupaten','=','regencies.id')
                                ->leftjoin('districts','pos.kecamatan','=','districts.id')
                                ->leftjoin('villages','pos.kelurahan','=','villages.id')
                                ->whereIn('pos_id', $id)->paginate(10);
        }

        return view('pos/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get semua data
        $provinces = Province::all();
        $regencies = Regency::all();
        $districts = District::all();
        $villages = Village::all();

        // Cari berdasarkan nama
        $provinces = Province::where('name', 'JAWA BARAT')->first();
        $regencies = Regency::where('name', 'LIKE', '%CIANJUR%')->first(); // kabupaten
        $districts = District::where('name', 'LIKE', 'BANDUNG%')->get();
        $villages = Village::where('name', 'BOJONGHERANG')->first();

        $pos = UserPosModel::all();
        return view('pos/create', compact('pos'));
    }

    public function updateStatusPos(Request $request, $id)
    {
        PosModel::where('id', $id)->update([
            'status_offering' => $request->status,
        ]);

        return response()->json("Berhasil");
    }

    public function updateNoSc(Request $request, $id)
    {

        if ($request->no_sc) {
            $progres      = "PSB belum aktif";
            $status_bayar = "Belum bayar";
        }else{
            $progres      = NULL;
            $status_bayar = NULL;
        }

        PosModel::where('id', $id)->update([
            'no_sc'        => $request->no_sc,
            'progres'      => $progres,
            'status_bayar' => $status_bayar
        ]);

        return response()->json("Berhasil");
    }

    public function updateStatusHubungi($id)
    {
        PosModel::where('id', $id)->update([
            'status_fu' => 'sudah dihubungi'
        ]);

        return response()->json("Berhasil");
    }

    public function provinces()
    {
        return Province::all();
    }

    public function regencies($province_id)
    {
        return Regency::where('province_id', $province_id)->get();
    }

    public function districts($regency_id)
    {
        return District::where('regency_id', $regency_id)->get();
    }

    public function villages($district_id)
    {
        return Village::where('district_id', $district_id)->get();
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
            'provinsi'    => 'required',
            'kabupaten'   => 'required',
            'kecamatan'   => 'required',
            'kelurahan'   => 'required',
            'pos_id'      => 'required'
        ]);

        $data = $request->all();

        $check = $this->saveData($data);

        if (!empty($request->from_frontend)) {
            return redirect()->back()->withErrors(['msg' => 'Simpan Berhasil!']);
        } else {
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
            "provinsi"    => $data['provinsi'],
            "kabupaten"   => $data['kabupaten'],
            "kecamatan"   => $data['kecamatan'],
            "kelurahan"   => $data['kelurahan'],
            "tgl_order"   => date('Y-m-d'),
            "pos_id"      => $data['pos_id'],
            "pos_name"    => $pos->nama,
            "status_fu"   => "belum dihubungi"
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
        $data = PosModel::select([
                            'pos.*',
                            'provinces.name AS provinsi',
                            'regencies.name AS kabupaten',
                            'districts.name AS kecamatan',
                            'villages.name AS kelurahan',
                         ])
                         ->join('provinces','pos.provinsi','=','provinces.id')
                         ->join('regencies','pos.kabupaten','=','regencies.id')
                         ->join('districts','pos.kecamatan','=','districts.id')
                         ->join('villages','pos.kelurahan','=','villages.id')
                         ->where('pos.id', $id)->first();
        
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
        $data = PosModel::select([
                                    'pos.*',
                                    'provinces.name AS provinsi',
                                    'regencies.name AS kabupaten',
                                    'districts.name AS kecamatan',
                                    'villages.name AS kelurahan',
                                ])
                                ->join('provinces','pos.provinsi','=','provinces.id')
                                ->join('regencies','pos.kabupaten','=','regencies.id')
                                ->join('districts','pos.kecamatan','=','districts.id')
                                ->join('villages','pos.kelurahan','=','villages.id')
                                ->where('pos.id', $id)->first();

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

        PosModel::where('id', $id)->update([
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
        PosModel::where('id', $id)->delete();
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
