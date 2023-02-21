<?php

namespace App\Http\Controllers;

use App\Models\MateriPromosiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class MateriPromosiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MateriPromosiModel::paginate(10);
        $role = Auth::guard('user_regionals')->user()->id ?? 0;
        return view('materi-promosi/index', compact('data', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materi-promosi/create');
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
            'nama_program'   => 'required',
            'link'           => 'required',
            'periode_rilis'  => 'required',
            'tahun'          => 'required',
            'berlaku_hingga' => 'required',
        ]);

        $data = $request->all();

        $check = $this->saveData($data);

        return redirect("materi-promosi")->withErrors(['msg' => 'Berhasil Tambah Data!']);
    }

    public function saveData(array $data)
    {

        if (!empty(Auth::guard('user_regionals')->user()->id)) {
            $id_user = Auth::guard('user_regionals')->user()->id;
        }
    
        if (!empty(Auth::guard('user_pos')->user()->id)) {
            $id_user = Auth::guard('user_pos')->user()->id;
        }
    
        if (!empty(Auth::guard('user_pic')->user()->id)) {
            $id_user = Auth::guard('user_pic')->user()->id;
        }

        $file = $data['link'];
        $tujuan_upload = public_path('uploads');
        $file->move($tujuan_upload,$file->getClientOriginalName());

        MateriPromosiModel::create([
            'nama_program'   => $data['nama_program'],
            'link'           => $file->getClientOriginalName(),
            'periode_rilis'  => $data['periode_rilis'],
            'tahun'          => $data['tahun'],
            'berlaku_hingga' => $data['berlaku_hingga'],
            'createdby'      => $id_user,
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
        $data = MateriPromosiModel::where('id', $id)->first();
        return view('materi-promosi/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MateriPromosiModel::where('id', $id)->first();
        return view('materi-promosi/edit', compact('data'));
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
        $query = MateriPromosiModel::where('id', $id);

        $file = $request->link;

        if (empty($request->link)) {
            $old = $query->first();
            $file = $old->link;
        }

        $query->update([
            'nama_program'   => $request->nama_program,
            'link'           => $file,
            'periode_rilis'  => $request->periode_rilis,
            'tahun'          => $request->tahun,
            'berlaku_hingga' => $request->berlaku_hingga
        ]);

        return redirect("materi-promosi")->withErrors(['msg' => 'Berhasil Update Data!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MateriPromosiModel::where('id', $id)->delete();
        return redirect("materi-promosi")->withErrors(['msg' => 'Berhasil Hapus Data!']);
    }
}
