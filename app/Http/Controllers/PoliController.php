<?php

namespace App\Http\Controllers;

use App\Models\poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $new_poli;
    public function __construct()
    {
        $this->new_poli = new poli();

        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-staff')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    public function index(Request $request)
    {
        $batas = 5;
        $data = poli::simplePaginate($batas);

        $nomor = $batas * ($data->currentPage() - 1);

        $name = $request->nama_poli;
        $id_user = Auth::user()->id;

        // $data = poli::where('nama_poli', 'LIKE', "%$name%")->simplePaginate($batas);

        $data   =  DB::table('tbl_poli')
            ->join('tbl_puskesmas', 'tbl_poli.puskesmas_id', 'tbl_puskesmas.id')
            ->select('tbl_poli.*', 'tbl_poli.id as id_poli', 'tbl_puskesmas.*', 'tbl_puskesmas.id as id_puskesmas', 'tbl_puskesmas.nama as nama_puskesmas')
            ->where('tbl_poli.nama_poli', 'LIKE', "%$name%")
            ->where('admin_id', 'LIKE', $id_user)
            ->simplePaginate($batas);

        // $jumlah = poli::count();
        $jumlah = DB::table('tbl_poli')
            ->join('tbl_puskesmas', 'tbl_poli.puskesmas_id', 'tbl_puskesmas.id')
            ->select('tbl_poli.*', 'tbl_poli.id as id_poli', 'tbl_puskesmas.*', 'tbl_puskesmas.id as id_puskesmas', 'tbl_puskesmas.nama as nama_puskesmas')
            ->where('tbl_poli.nama_poli', 'LIKE', "%$name%")
            ->where('admin_id', 'LIKE', $id_user)
            ->get()
            ->count();


        // dd($data);
        return view('poli.index', [
            'totalData' => $jumlah,
            'data' => $data,
            'no' => $nomor
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('poli.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_poli' => "required|min:5|max:30",
            'kode_poli' => "required|max:15|unique:tbl_poli,kode_poli",
            'ruang_poli' => "required|min:4|max:30",

        ];
        $messages = [
            'required' => ":attribute tidak boleh kosong",
            'min' => ":attribute karakter terlalu pendek",
            'max' => ":attribute karakter terlalu panjang / terlalu besar",
            'mimes' => ":attribute ekstensi error, gunakan .png, .jpg, .jpeg",
            'unique' => ":attribute sudah ada, silahkan masukkan :attribute lain"
        ];
        $this->validate($request, $rules, $messages);

        $id_user = Auth::user()->id;

        $data   =  DB::table('tbl_puskesmas')
            ->join('users', 'users.id', 'tbl_puskesmas.admin_id')
            ->select('users.*', 'users.id as id_user', 'tbl_puskesmas.*', 'tbl_puskesmas.id as id_puskesmas')
            ->where('admin_id', 'LIKE', $id_user)
            ->first();

        // dd($data->id_puskesmas);
        $this->new_poli->kode_poli = $request->kode_poli;
        $this->new_poli->nama_poli = $request->nama_poli;
        $this->new_poli->ruang_poli = $request->ruang_poli;
        $this->new_poli->puskesmas_id = $data->id_puskesmas;

        $this->new_poli->save();
        return redirect()->route('puskesmas.create')->with('status', 'Created Successfully | Silahkan tambahkan poli yang telah dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\poli  $poli
     * @return \Illuminate\Http\Response
     */
    public function show(poli $poli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\poli  $poli
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poli_edit = poli::find($id);
        return view('poli.edit', [
            'dataPoli' => $poli_edit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\poli  $poli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $poli_edit = poli::find($id);
        $poli_edit->kode_poli = $request->kode_poli;
        $poli_edit->nama_poli = $request->nama_poli;
        $poli_edit->ruang_poli = $request->ruang_poli;

        $poli_edit->save();
        return redirect()->route('poli')->with('status', 'Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\poli  $poli
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poli_hapus = poli::findOrFail($id);

        $poli_hapus->delete();
        return redirect()->route('poli')->with('status', 'Data berhasil dihapus');
    }
}
