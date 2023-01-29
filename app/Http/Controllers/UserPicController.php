<?php

namespace App\Http\Controllers;

use App\Models\UserPicModel;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\UserRegionalModel;
use App\Models\Witel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class UserPicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = UserPicModel::paginate(10);
        $role = Auth::guard('user_regionals')->user()->id ?? 0;
        return view('user-pic/index', compact('data', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $witel = Witel::select('witel')
                        ->groupBy('witel')
                        ->get();
        $regional = UserRegionalModel::all();
        return view('user-pic/create', compact('regional', 'witel'));
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
            // 'name'       => 'required',
            'email'      => 'required|email|unique:user_pic',
            'password'   => 'required|min:6',
            'notel'      => 'required',
            'witel'      => 'required',
            'datel'      => 'required',
        ]);

        $data = $request->all();
        // dd($data);
        $check = $this->saveData($data);

        return redirect("user-pic")->withErrors(['msg' => 'Berhasil Tambah Data!']);
    }

    public function saveData(array $data)
    {
        $host = URL::to('/');

        $insert = UserPicModel::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'notel'    => $data['notel'],
            'regional' => 'DIVRE 5',
            'witel'    => $data['witel'],
            'datel'    => $data['datel'],
            'url'      => ''
        ]);

        $url = 'https://telkomregional5.id/shorturl/insert.php';

        $txt = "url=" . $host . "/create-user-pos-from-user-pic/" . $insert->id;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $txt);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $a = (array) json_decode($result);

        // dd($a);
        // after that, update column url
        UserPicModel::where('id', $insert->id)->update([
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
        $data = UserPicModel::where('id', $id)->first();
        return view('user-pic/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regional = UserRegionalModel::all();
        $data = UserPicModel::where('id', $id)->first();
        return view('user-pic/edit', compact('data', 'regional'));
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
        UserPicModel::where('id', $id)->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'notel'    => $request->notel,
            'regional' => $request->regional,
            'witel'    => $request->witel,
            'datel'    => $request->datel,
            'url'      => $request->url,
        ]);

        return redirect("user-pic")->withErrors(['msg' => 'Berhasil Update Data!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserPicModel::where('id', $id)->delete();
        return redirect("user-pic")->withErrors(['msg' => 'Berhasil Hapus Data!']);
    }

    public function getDatel($id_witel)
    {
        $datel = Witel::select('datel')
                        ->groupBy('datel')
                        ->where('witel', $id_witel)
                        ->get();
        return response()->json($datel);
    }
}
