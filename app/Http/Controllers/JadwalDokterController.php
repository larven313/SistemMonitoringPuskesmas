<?php

namespace App\Http\Controllers;

use App\Models\jadwalDokter;
use App\Models\dokter;
use App\Models\puskesmas_item;
use App\Models\puskesmas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JadwalDokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $new_jadwal_dokter;
    public function __construct()
    {
        $this->new_jadwal_dokter = new jadwalDokter();

        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-categories')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    public function index(Request $request)
    {
        $batas = 5;
        $data = jadwalDokter::simplePaginate($batas);

        $nomor = $batas * ($data->currentPage() - 1);

        $name = $request->nama_dokter;
        // $puskesmas_id = DB::table('tbl_jadwal_dokter')
        //     ->select('puskesmas_id');

        // $puskesmas =  DB::table('tbl_puskesmas_item')
        //     ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
        //     ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
        //     ->select('tbl_puskesmas.*', 'tbl_puskesmas_item.*',  'tbl_poli.*')
        //     ->where('tbl_puskesmas_item.puskesmas_id', 'LIKE', "%$puskesmas_id%");
        $id_user = Auth::user()->id;

        if (Auth::user()->roles == '["STAFF"]') {
            $data =  DB::table('tbl_jadwal_dokter')
                ->join('tbl_dokter', 'tbl_jadwal_dokter.dokter_id', '=', 'tbl_dokter.id')
                ->join('tbl_puskesmas_item', 'tbl_jadwal_dokter.puskesmas_id', '=', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
                ->select('tbl_dokter.*', 'tbl_puskesmas_item.*', 'tbl_jadwal_dokter.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama')
                ->where('admin_id', 'LIKE', $id_user)
                ->where('tbl_dokter.nama_dokter', 'LIKE', "%$name%")
                ->orderBy('tbl_jadwal_dokter.hari')
                ->simplePaginate($batas);
            $jumlah = DB::table('tbl_jadwal_dokter')
                ->join('tbl_puskesmas_item', 'tbl_jadwal_dokter.puskesmas_id', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->select('tbl_jadwal_dokter.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('admin_id', 'LIKE', $id_user)->get()
                ->count();
        } else {
            $data =  DB::table('tbl_jadwal_dokter')
                ->join('tbl_dokter', 'tbl_jadwal_dokter.dokter_id', '=', 'tbl_dokter.id')
                ->join('tbl_puskesmas_item', 'tbl_jadwal_dokter.puskesmas_id', '=', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
                ->select('tbl_dokter.*', 'tbl_puskesmas_item.*', 'tbl_jadwal_dokter.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama')
                ->where('tbl_dokter.nama_dokter', 'LIKE', "%$name%")
                ->orderBy('tbl_jadwal_dokter.hari')
                ->simplePaginate($batas);
            $jumlah = jadwalDokter::count();
        }





        return view('jadwal-dokter.index', [
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


        $puskesmas_show = puskesmas_item::all();

        $id_user = Auth::user()->id;
        if (Auth::user()->roles == '["STAFF"]') {

            $puskesmas = DB::table('tbl_puskesmas_item')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
                ->select('tbl_puskesmas_item.*', 'tbl_puskesmas.nama', 'tbl_poli.nama_poli')
                ->where('tbl_puskesmas.admin_id', '=', $id_user)
                ->orderBy('tbl_puskesmas_item.puskesmas_id')
                ->get();

            $dokter_show = dokter::join('tbl_puskesmas', 'tbl_puskesmas.id', '=', 'tbl_dokter.puskesmas_id')
                ->where('tbl_puskesmas.admin_id', '=', $id_user)
                ->select('tbl_puskesmas.*', 'tbl_dokter.*', 'tbl_puskesmas.id as id_puskesmas')
                ->get();

            // dd($dokter_show);
        } else if (Auth::user()->roles == '["ADMIN"]') {
            $puskesmas = DB::table('tbl_puskesmas_item')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
                ->select('tbl_puskesmas_item.*', 'tbl_puskesmas.nama', 'tbl_poli.nama_poli')
                ->orderBy('tbl_puskesmas_item.puskesmas_id')
                ->get();

            $dokter_show = dokter::all();
        }
        // dd($puskesmas->nama);
        // foreach ($puskesmas as $item_puskesmas) {
        //     $puskesmas = $item_puskesmas['nama'];

        // }

        $day = ['Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu', 'Minggu'];

        // dd($day);

        return view('jadwal-dokter.create', [
            'dataDokter' => $dokter_show,
            'dataPuskesmas' => $puskesmas_show,
            'hari' => $day,
            'puskesmas' => $puskesmas

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
            'dokter_id' => "required|max:100",
            'hari' => "required",
            'jam_masuk' => "required",
            'jam_keluar' => "required"

        ];
        $messages = [
            'required' => ":attribute tidak boleh kosong",
            'min' => ":attribute karakter terlalu pendek",
            'max' => ":attribute karakter terlalu panjang / terlalu besar",
            'mimes' => ":attribute ekstensi error, gunakan .png, .jpg, .jpeg",
            'unique' => ":attribute sudah ada, silahkan masukkan :attribute lain"
        ];
        $this->validate($request, $rules, $messages);


        // $nm = $request->image;

        // $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
        $this->new_jadwal_dokter->dokter_id = $request->dokter_id;
        $this->new_jadwal_dokter->hari = $request->hari;
        $this->new_jadwal_dokter->puskesmas_id = $request->puskesmas_id;
        $this->new_jadwal_dokter->jam_masuk = $request->jam_masuk;
        $this->new_jadwal_dokter->jam_keluar = $request->jam_keluar;

        // var_dump($request->puskesmas_id);
        // dd($request);

        // $this->new_jadwal_dokter->image = $namaFile;

        // $nm->move(public_path() . '/img', $namaFile);
        // $this->new_jadwal_dokter->slug = Str::slug($request->nama_dokter, '-');
        $this->new_jadwal_dokter->save();

        return redirect()->route('jadwal-dokter')->with('status', 'Data Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jadwalDokter  $jadwalDokter
     * @return \Illuminate\Http\Response
     */
    public function show(jadwalDokter $jadwalDokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jadwalDokter  $jadwalDokter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwal_edit = jadwalDokter::find($id);

        $dokter_show = dokter::all();
        $puskesmas_show = puskesmas_item::all();

        $puskesmas = DB::table('tbl_puskesmas_item')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
            ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
            ->select('tbl_puskesmas_item.*', 'tbl_puskesmas.nama', 'tbl_poli.nama_poli')
            ->orderBy('tbl_puskesmas_item.puskesmas_id')
            ->get();
        // foreach ($puskesmas as $item_puskesmas) {
        //     $puskesmas = $item_puskesmas['nama'];

        // }

        $day = ['Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu', 'Minggu'];

        // dd($day);

        return view('jadwal-dokter.edit', [
            'dataDokter' => $dokter_show,
            'dataPuskesmas' => $puskesmas_show,
            'hari' => $day,
            'puskesmas' => $puskesmas,
            'dataJadwal' => $jadwal_edit

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jadwalDokter  $jadwalDokter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jadwal_edit = jadwalDokter::find($id);
        $jadwal_edit->dokter_id = $request->dokter_id;
        $jadwal_edit->hari = $request->hari;
        $jadwal_edit->puskesmas_id = $request->puskesmas_id;
        $jadwal_edit->jam_masuk = $request->jam_masuk;
        $jadwal_edit->jam_keluar = $request->jam_keluar;

        $jadwal_edit->save();
        return redirect()->route('jadwal-dokter')->with('status', 'Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jadwalDokter  $jadwalDokter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal_hapus = jadwalDokter::findOrFail($id);

        $jadwal_hapus->delete();
        return redirect()->route('jadwal-dokter')->with('status', 'Data berhasil dihapus');
    }
}
