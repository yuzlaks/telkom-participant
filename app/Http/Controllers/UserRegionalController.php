<?php

namespace App\Http\Controllers;

use App\Models\UserRegionalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRegionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = UserRegionalModel::paginate(10);
        $role = Auth::guard('user_regionals')->user()->role ?? "";
        return view('user-regional/index', compact('data','role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user-regional/create');
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
            'name' => 'required',
            'email' => 'required|email|unique:user_regional',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->saveData($data);
         
        return redirect("user-regional")->withErrors(['msg' => 'Berhasil Tambah Data!']);
    }

    public function saveData(array $data)
    {
        UserRegionalModel::create([
            'username'  => $data['name'],
            'email'     => $data['email'],
            'job_title' => $data['job_title'],
            'role'      => $data['role'],
            'password'  => Hash::make($data['password']),
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
        $data = UserRegionalModel::where('id',$id)->first();
        return view('user-regional/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = UserRegionalModel::where('id',$id)->first();
        return view('user-regional/edit', compact('data'));
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
        UserRegionalModel::where('id',$id)->update([
            'username'  => $request->name,
            'email'     => $request->email,
            'job_title' => $request->job_title,
            'role'      => $request->role,
            'password'  => Hash::make($request->password),
        ]);

        return redirect("user-regional")->withErrors(['msg' => 'Berhasil Update Data!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserRegionalModel::where('id',$id)->delete();
        return redirect("user-regional")->withErrors(['msg' => 'Berhasil Hapus Data!']);
    }
}
