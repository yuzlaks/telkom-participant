<?php

namespace App\Http\Controllers;

use App\Models\UserPicModel;
use App\Models\UserPosModel;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class UserPosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_regional = Auth::guard('user_regionals')->user()->id ?? 0;
        $role_pic = Auth::guard('user_pic')->user()->id ?? 0;

        

        if ($role_pic != 0) {
            $data = UserPosModel::where('pic_id', $role_pic)->paginate(10);
        }else{
            $data = UserPosModel::paginate(10);
        }
        
        return view('user-pos/index', compact('data','role_regional','role_pic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pic = UserPicModel::all();
        return view('user-pos/create', compact('pic'));
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
        $check = $this->saveData($data);

        if (!empty($request->from_frontend)) {
            return redirect()->back()->withErrors(['msg' => 'Simpan Berhasil!']);
        }else{
            return redirect("user-pos")->withErrors(['msg' => 'Simpan Berhasil!']);
        }
         
    }

    public function saveData(array $data)
    {
        $host = URL::to('/');
        $pic = UserPicModel::where('id',$data['pic_id'])->first();

        $insert = UserPosModel::create([
            'nama'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'notel'     => $data['notel'],
            'pic_id'    => $pic->id,
            'pic_name'  => $pic->name,
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = UserPosModel::select([
                                'user_pos.*',
                                'provinces.name AS provinsi',
                                'regencies.name AS kabupaten',
                                'districts.name AS kecamatan',
                                'villages.name AS kelurahan',
                            ])
                            ->join('provinces','user_pos.provinsi','=','provinces.id')
                            ->join('regencies','user_pos.kabupaten','=','regencies.id')
                            ->join('districts','user_pos.kecamatan','=','districts.id')
                            ->join('villages','user_pos.kelurahan','=','villages.id')
                            ->where('user_pos.id',$id)->first();
        return view('user-pos/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pic = UserPicModel::all();
        $data = UserPosModel::where('id',$id)->first();
        return view('user-pos/edit', compact('data','pic'));
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
        $pic = UserPicModel::where('id',$request->pic_id)->first();
        UserPosModel::where('id',$id)->update([
            'nama'      => $request->name,
            'email'     => $request->email,
            'notel'     => $request->notel,
            'password'  => Hash::make($request->password),
            'pic_id'    => $pic->id,
            'pic_name'  => $pic->name,
            'alamat'    => $request->alamat,
            'provinsi'  => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'url'       => $request->url
        ]);

        return redirect("user-pos")->withErrors(['msg' => 'Berhasil Update Data!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserPosModel::where('id',$id)->delete();
        return redirect("user-pos")->withErrors(['msg' => 'Berhasil Hapus Data!']);
    }
}
