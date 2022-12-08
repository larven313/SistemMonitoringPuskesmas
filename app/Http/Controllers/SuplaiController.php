<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\suplai;
use App\Models\obat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SuplaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $new_suplai;
    public function __construct()
    {
        $this->new_suplai = new suplai();

        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-categories')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    public function index(Request $request)
    {

        $batas = 5;
        $data = suplai::simplePaginate($batas);

        $nomor = $batas * ($data->currentPage() - 1);

        $name = $request->nama_supplier;
        $id_user = Auth::user()->id;
        $jumlah = suplai::where('nama_supplier', 'LIKE', "%$name%")
            ->join('tbl_puskesmas', 'tbl_puskesmas.id', '=', 'tbl_suplai.puskesmas_id')
            ->select('tbl_puskesmas.*', 'tbl_puskesmas.nama as nama_puskesmas', 'tbl_suplai.*', 'tbl_suplai.id as id_suplai')
            ->where('tbl_puskesmas.admin_id', 'LIKE', "$id_user")
            ->get()
            ->count();
        $data = suplai::where('nama_supplier', 'LIKE', "%$name%")
            ->join('tbl_puskesmas', 'tbl_puskesmas.id', '=', 'tbl_suplai.puskesmas_id')
            ->select('tbl_puskesmas.*', 'tbl_puskesmas.nama as nama_puskesmas', 'tbl_suplai.*', 'tbl_suplai.id as id_suplai')
            ->where('tbl_puskesmas.admin_id', 'LIKE', "$id_user")
            ->simplePaginate($batas);

        // $data = suplai::where('nama_supplier', 'LIKE', "%$name%")
        //     ->join('tbl_obat', 'tbl_suplai.id', '=', 'tbl_obat.suplier_id')
        //     ->simplePaginate($batas);

        // $data =  DB::table('tbl_pemasukan_obat')
        //     ->join('tbl_obat', 'tbl_pemasukan_obat.obat_id', '=', 'tbl_obat.id')
        //     ->join('tbl_suplai', 'tbl_pemasukan_obat.supplier_id', '=', 'tbl_suplai.id')
        //     ->select('tbl_obat.*', 'tbl_suplai.*', 'tbl_pemasukan_obat.*')
        //     ->where('tbl_suplai.nama_supplier', 'LIKE', "%$name%")
        //     ->simplePaginate($batas);

        return view('suplai.index', [
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

        $id_user = Auth::user()->id;

        $data = DB::table('tbl_puskesmas')
            ->where('admin_id', 'LIKE', $id_user)
            ->select('tbl_puskesmas.*', 'tbl_puskesmas.id as id_puskesmas')
            ->get();

        $data_admin = DB::table('tbl_puskesmas')
            ->select('tbl_puskesmas.*', 'tbl_puskesmas.id as id_puskesmas')
            ->get();

        return view('suplai.create', [
            'puskesmas' => $data,
            'puskesmas_admin' => $data_admin
        ]);
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
            'nama_supplier' => "required|min:5|max:20", //unique : nama_tabel, nama_kolom
            'kode_supplier' => "required|min:3|max:12",
            'perusahaan' => "required|min:4|max:20"

        ];
        $messages = [
            'required' => ":attribute tidak boleh kosong",
            'min' => ":attribute karakter terlalu pendek",
            'max' => ":attribute karakter terlalu panjang / terlalu besar",
            'mimes' => ":attribute ekstensi error, gunakan .png, .jpg, .jpeg",
            'unique' => ":attribute sudah ada, silahkan masukkan :attribute lain"
        ];
        $this->validate($request, $rules, $messages);





        $this->new_suplai->kode_supplier = $request->kode_supplier;
        $this->new_suplai->nama_supplier = $request->nama_supplier;
        $this->new_suplai->perusahaan = $request->perusahaan;
        $this->new_suplai->puskesmas_id = $request->puskesmas_id;





        $this->new_suplai->save();
        return redirect()->route('suplai')->with('status', 'Created Successfully ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\suplai  $suplai
     * @return \Illuminate\Http\Response
     */
    public function show(suplai $suplai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\suplai  $suplai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suplai_edit = suplai::find($id);
        return view('suplai.edit', [
            'dataSuplai' => $suplai_edit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\suplai  $suplai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $suplai_edit = suplai::find($id);
        $suplai_edit->kode_supplier = $request->kode_supplier;
        $suplai_edit->nama_supplier = $request->nama_supplier;
        $suplai_edit->perusahaan = $request->perusahaan;


        $suplai_edit->save();
        return redirect()->route('suplai')->with('status', 'Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\suplai  $suplai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $suplai_hapus = suplai::findOrFail($id);

        $suplai_hapus->delete();
        return redirect()->route('suplai')->with('status', 'Data berhasil dihapus');
    }
}
