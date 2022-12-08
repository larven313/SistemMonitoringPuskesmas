<?php

namespace App\Http\Controllers;

use App\Models\obat;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $new_obat;
    public function __construct()
    {
        $this->new_obat = new obat();

        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-guest')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    public function index(Request $request)
    {

        $batas = 5;
        $data = obat::simplePaginate($batas);

        $nomor = $batas * ($data->currentPage() - 1);

        $name = $request->nama_obat;
        $id_user = Auth::user()->id;


        if (Auth::user()->roles == '["STAFF"]') {
            $data = obat::join('tbl_puskesmas', 'tbl_puskesmas.id', '=', 'tbl_obat.puskesmas_id')
                ->select('tbl_obat.*', 'tbl_puskesmas.*', 'tbl_puskesmas.id as id_puskesmas', 'tbl_obat.id as id_obat')
                ->where('nama_obat', 'LIKE', "%$name%")
                ->where('admin_id', 'LIKE', $id_user)
                ->simplePaginate($batas);

            $jumlah = obat::join('tbl_puskesmas', 'tbl_puskesmas.id', '=', 'tbl_obat.puskesmas_id')
                ->where('admin_id', 'LIKE', $id_user)->count();
        } else {
            $data = obat::join('tbl_puskesmas', 'tbl_puskesmas.id', '=', 'tbl_obat.puskesmas_id')
                ->select('tbl_obat.*', 'tbl_puskesmas.*', 'tbl_puskesmas.id as id_puskesmas', 'tbl_obat.id as id_obat')
                ->where('nama_obat', 'LIKE', "%$name%")
                ->simplePaginate($batas);

            $jumlah = obat::count();
        }


        return view('obat.index', [
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

        // dd($data);

        // dd($data['0']->id_puskesmas);
        return view('obat.create', [
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
            'nama_obat' => "required|min:5|max:20", //unique : nama_tabel, nama_kolom
            'kode_obat' => "required|min:3|max:15|unique:tbl_obat,kode_obat",
            'jenis_obat' => "required|min:3|max:50",
            'dosis_aturan_obat' => "required|min:5",
            'satuan' => "required|min:3|max:16"

        ];
        $messages = [
            'required' => ":attribute tidak boleh kosong",
            'min' => ":attribute karakter terlalu pendek",
            'max' => ":attribute karakter terlalu panjang / terlalu besar",
            'mimes' => ":attribute ekstensi error, gunakan .png, .jpg, .jpeg",
            'unique' => ":attribute sudah ada, silahkan masukkan :attribute lain"
        ];
        $this->validate($request, $rules, $messages);




        $this->new_obat->kode_obat = $request->kode_obat;
        $this->new_obat->nama_obat = $request->nama_obat;
        $this->new_obat->jenis_obat = $request->jenis_obat;
        // $this->new_obat->roles = json_encode($request->roles);
        $this->new_obat->stok = $request->stok;
        $this->new_obat->min_stok = $request->min_stok;
        $this->new_obat->dosis_aturan_obat = $request->dosis_aturan_obat;
        $this->new_obat->satuan = $request->satuan;
        $this->new_obat->puskesmas_id = $request->puskesmas_id;




        $this->new_obat->save();
        return redirect()->route('obat')->with('status', 'Created Successfully ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('categories')
            ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
            ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
            ->select('categories.*', 'tbl_poli.nama_poli')
            ->where('categories.id', 'LIKE', $id)
            ->first();

        $obat = DB::table('categories')
            ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
            ->join('tbl_obat', 'tbl_obat.id', 'categories.obat_id')
            ->select('categories.*', 'tbl_puskesmas.nama', 'tbl_obat.*', 'categories.nama as nama_pasien')
            ->where('categories.user_id', 'LIKE', $id)
            ->first();

        // dd($obat);

        return view(
            'obat.show',
            [
                'showKategori' => $data,
                'showObat' => $obat

            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obat_edit = Obat::find($id);
        return view('obat.edit', [
            'dataObat' => $obat_edit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $obat_edit = Obat::find($id);
        $obat_edit->kode_obat = $request->kode_obat;
        $obat_edit->nama_obat = $request->nama_obat;
        $obat_edit->jenis_obat = $request->jenis_obat;
        $obat_edit->stok = $request->stok;
        $obat_edit->min_stok = $request->min_stok;
        $obat_edit->dosis_aturan_obat = $request->dosis_aturan_obat;
        $obat_edit->satuan = $request->satuan;

        $obat_edit->save();
        return redirect()->route('obat')->with('status', 'Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_hapus = Obat::findOrFail($id);

        // dd($user_hapus);
        $user_hapus->delete();


        return redirect()->route('obat')->with('status', 'Data berhasil dihapus');
    }
}
