<?php

namespace App\Http\Controllers;

use App\Models\UserPicModel;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\UserRegionalModel;
use Illuminate\Support\Facades\Auth;

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
        return view('user-pic/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regional = UserRegionalModel::all();
        return view('user-pic/create', compact('regional'));
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
            'regional'   => 'required',
            'witel'      => 'required',
            'datel'      => 'required',
        ]);
           
        $data = $request->all();
        $check = $this->saveData($data);
         
        return redirect("user-pic")->withErrors(['msg' => 'Berhasil Tambah Data!']);
    }

    public function saveData(array $data)
    {
        $insert = UserPicModel::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'notel'    => $data['notel'],
            'regional' => $data['regional'],
            'witel'    => $data['witel'],
            'datel'    => $data['datel'],
            'url'      => ''
        ]);

        // after that, update column url
        UserPicModel::where('id', $insert->id)->update([
            'url' => 'create-user-pos-from-user-pic/'.$insert->id
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
        $data = UserPicModel::where('id',$id)->first();
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
        $data = UserPicModel::where('id',$id)->first();
        return view('user-pic/edit', compact('data','regional'));
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
        UserPicModel::where('id',$id)->update([
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
        UserPicModel::where('id',$id)->delete();
        return redirect("user-pic")->withErrors(['msg' => 'Berhasil Hapus Data!']);
    }
}
