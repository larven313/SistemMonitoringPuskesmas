<?php

namespace App\Http\Controllers;

use App\Models\pemasukanObat;
use App\Models\suplai;
use App\Models\obat;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemasukanObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $new_pemasukan;
    public function __construct()
    {
        $this->new_pemasukan = new pemasukanObat();

        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-categories')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    public function index(Request $request)
    {

        $batas = 5;
        $data = pemasukanObat::simplePaginate($batas);

        $nomor = $batas * ($data->currentPage() - 1);

        $name = $request->nama_supplier;

        // $data = pemasukanObat::where('nama_supplier', 'LIKE', "%$name%")->simplePaginate($batas);

        // $data = pemasukanObat::where('nama_supplier', 'LIKE', "%$name%")
        //     ->join('tbl_obat', 'tbl_suplai.id', '=', 'tbl_obat.suplier_id')
        //     ->simplePaginate($batas);
        $id_user = Auth::user()->id;

        if (Auth::user()->roles == '["STAFF"]') {
            $jumlah = pemasukanObat::join('tbl_puskesmas', 'tbl_puskesmas.id', '=', 'tbl_pemasukan_obat.puskesmas_id')
                ->where('admin_id', 'LIKE', "$id_user")
                ->get()
                ->count();

            $data =  DB::table('tbl_pemasukan_obat')
                ->join('tbl_suplai', 'tbl_pemasukan_obat.supplier_id', '=', 'tbl_suplai.id')
                ->join('tbl_obat', 'tbl_pemasukan_obat.obat_id', '=', 'tbl_obat.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas.id', '=', 'tbl_pemasukan_obat.puskesmas_id')
                ->select('tbl_obat.*', 'tbl_obat.id as id_obat', 'tbl_suplai.*', 'tbl_suplai.id as id_suplai', 'tbl_pemasukan_obat.*', 'tbl_pemasukan_obat.id as id_pemasukan', 'tbl_puskesmas.*', 'tbl_puskesmas.id as id_puskesmas')
                ->where('tbl_suplai.nama_supplier', 'LIKE', "%$name%")
                ->where('admin_id', 'LIKE', "$id_user")
                ->simplePaginate($batas);

            // dd($data);
        } else {
            $jumlah = pemasukanObat::count();
            $data =  DB::table('tbl_pemasukan_obat')
                ->join('tbl_obat', 'tbl_pemasukan_obat.obat_id', '=', 'tbl_obat.id')
                ->join('tbl_suplai', 'tbl_pemasukan_obat.supplier_id', '=', 'tbl_suplai.id')
                ->select('tbl_obat.*', 'tbl_suplai.*', 'tbl_pemasukan_obat.*')
                ->where('tbl_suplai.nama_supplier', 'LIKE', "%$name%")
                ->simplePaginate($batas);
        }

        return view('pemasukan-obat.index', [
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
        // $supplier = $request->id;
        $id_user = Auth::user()->id;

        if (Auth::user()->roles == '["STAFF"]') {
            $id_puskesmas = DB::table('tbl_puskesmas')
                ->join('users', 'users.id', 'tbl_puskesmas.admin_id')
                ->select('tbl_puskesmas.*', 'users.*', 'tbl_puskesmas.id as id_puskesmas')
                ->where('users.id', 'LIKE', $id_user)
                ->get();

            $category_show = suplai::join('tbl_puskesmas', 'tbl_puskesmas.id', 'tbl_suplai.puskesmas_id')
                ->where('admin_id', 'LIKE', $id_user)
                ->select('tbl_suplai.*', 'tbl_puskesmas.*', 'tbl_suplai.id as id_supplier')
                ->get();

            $obat_show = obat::join('tbl_puskesmas', 'tbl_puskesmas.id', 'tbl_obat.puskesmas_id')
                ->where('admin_id', 'LIKE', $id_user)
                ->select('tbl_obat.*', 'tbl_puskesmas.*', 'tbl_obat.id as id_obat')
                ->get();

            // dd($obat_show);
        } else if (Auth::user()->roles == '["ADMIN"]') {
            $category_show = suplai::join('tbl_puskesmas', 'tbl_puskesmas.id', 'tbl_suplai.puskesmas_id')

                ->select('tbl_suplai.*', 'tbl_puskesmas.*', 'tbl_suplai.id as id_supplier')
                ->get();

            $obat_show = obat::join('tbl_puskesmas', 'tbl_puskesmas.id', 'tbl_obat.puskesmas_id')

                ->select('tbl_obat.*', 'tbl_puskesmas.*', 'tbl_obat.id as id_obat')
                ->get();
        }


        return view('pemasukan-obat.create', [
            'dataSuplai' => $category_show,
            'dataObat' => $obat_show,
            'id_puskesmas' => $id_puskesmas

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
            'obat_id' => "required|min:1|max:11", //unique : nama_tabel, nama_kolom
            'supplier_id' => "required|min:1|max:30",
            'harga' => "required|min:4|max:60",
            'jumlah' => "required|min:1|max:5"


        ];
        $messages = [
            'required' => "tidak boleh kosong",
            'min' => ":attribute karakter terlalu pendek",
            'max' => ":attribute karakter terlalu panjang / terlalu besar",
            'mimes' => ":attribute ekstensi error, gunakan .png, .jpg, .jpeg",
            'unique' => ":attribute sudah ada, silahkan masukkan :attribute lain"
        ];
        $this->validate($request, $rules, $messages);






        $this->new_pemasukan->no_trans = $request->no_trans;
        $this->new_pemasukan->supplier_id = $request->supplier_id;
        $this->new_pemasukan->puskesmas_id = $request->puskesmas_id;
        $this->new_pemasukan->obat_id = $request->obat_id;
        $this->new_pemasukan->harga = $request->harga;
        $this->new_pemasukan->jumlah = $request->jumlah;




        $this->new_pemasukan->save();
        return redirect()->route('pemasukan-obat')->with('status', 'Created Successfully ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\suplai  $suplai
     * @return \Illuminate\Http\Response
     */
    public function show(pemasukanObat $pemasukanObat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemasukanObat  $pemasukanObat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_show = suplai::all();
        $obat_show = obat::all();
        $pemasukan_edit = pemasukanObat::find($id);
        return view('pemasukan-obat.edit', [
            'dataPemasukan' => $pemasukan_edit,
            'dataSuplai' => $category_show,
            'dataObat' => $obat_show
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pemasukanObat  $pemasukanObat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pemasukan_edit = pemasukanObat::find($id);
        $pemasukan_edit->no_trans = $request->no_trans;
        $pemasukan_edit->supplier_id = $request->supplier_id;
        $pemasukan_edit->obat_id = $request->obat_id;
        $pemasukan_edit->harga = $request->harga;
        $pemasukan_edit->jumlah = $request->jumlah;

        $pemasukan_edit->save();
        return redirect()->route('pemasukan-obat')->with('status', 'Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemasukanObat  $pemasukanObat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemasukan_hapus = pemasukanObat::findOrFail($id);

        $pemasukan_hapus->delete();
        return redirect()->route('pemasukan-obat')->with('status', 'Data berhasil dihapus');
    }
}
