<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\puskesmas;
use App\Models\puskesmas_item;
use App\Models\poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PuskesmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $new_puskesmas;
    public $new_puskesmas_item;
    // public $new_poli;

    public function __construct()
    {
        $this->new_puskesmas = new puskesmas();
        $this->new_puskesmas_item = new puskesmas_item();
        // $this->new_poli = new poli();


        //gunakan middleware untuk cek Gate Authorize User nya
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-categories')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    public function index(Request $request)
    {
        // $jumlah =  DB::table('tbl_puskesmas_item')
        //     ->distinct('puskesmas_id')->count();


        $id = $request->id;

        $jmlh_poli = DB::table('tbl_puskesmas_item')
            ->select('*')
            ->groupBy('poli_id')->count();

        $batas = 5;
        $data = puskesmas::simplePaginate($batas);

        $nomor = $batas * ($data->currentPage() - 1);

        $id_user = Auth::user()->id;
        $name = $request->nama;
        if (Auth::user()->roles == '["STAFF"]') {
            $data = puskesmas::where('admin_id', 'LIKE', $id_user)->where('nama', 'LIKE', "%$name%")->simplePaginate($batas);
            $jumlah =  puskesmas::where('admin_id', 'LIKE', $id_user)->count();
        } else {
            $data = puskesmas::where('nama', 'LIKE', "%$name%")->simplePaginate($batas);
            $jumlah =  puskesmas::count();
        }





        // $data = puskesmas::where('nama_supplier', 'LIKE', "%$name%")
        //     ->join('tbl_obat', 'tbl_suplai.id', '=', 'tbl_obat.suplier_id')
        //     ->simplePaginate($batas);

        // $data =  DB::table('tbl_puskesmas')
        //     ->join('tbl_puskesmas_item', 'tbl_puskesmas.id', '=', 'tbl_puskesmas_item.puskesmas_id')
        //     ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
        //     ->select('tbl_puskesmas.*', 'tbl_poli.*', 'tbl_puskesmas_item.*')
        //     ->where('tbl_puskesmas.nama', 'LIKE', "%$name%")
        //     ->groupBy('tbl_puskesmas_item.puskesmas_id')
        //     ->simplePaginate($batas);

        return view('puskesmas.index', [
            'totalData' => $jumlah,
            'data' => $data,
            'no' => $nomor,
            'jumlahPoli' => $jmlh_poli
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
        $category_show = puskesmas::all();
        // $poli_show = poli::all();

        $id_user = Auth::user()->id;

        $id_puskesmas = DB::table('tbl_puskesmas')
            ->join('users', 'users.id', 'tbl_puskesmas.admin_id')
            ->select('tbl_puskesmas.*')
            ->where('tbl_puskesmas.admin_id', 'LIKE', $id_user)
            ->first();

        // $data = poli::where('nama_poli', 'LIKE', "%$name%")->simplePaginate($batas);

        $poli_show   =  DB::table('tbl_poli')
            ->join('tbl_puskesmas', 'tbl_poli.puskesmas_id', 'tbl_puskesmas.id')
            ->select('tbl_poli.*', 'tbl_poli.id as id_poli', 'tbl_puskesmas.*', 'tbl_puskesmas.id as id_puskesmas', 'tbl_puskesmas.nama as nama_puskesmas')
            ->where('tbl_poli.puskesmas_id', 'LIKE', $id_puskesmas->id)
            ->get();
        // dd($poli_show);


        return view('puskesmas.create', [
            'dataPuskesmas' => $category_show,
            'dataPoli' => $poli_show,

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
            'puskesmas_id' => "required|min:1|max:11",
            'poli_id' => "required|min:1|max:30",



        ];
        $messages = [
            'required' => "tidak boleh kosong",
            'min' => ":attribute karakter terlalu pendek",
            'max' => ":attribute karakter terlalu panjang / terlalu besar",
            'mimes' => ":attribute ekstensi error, gunakan .png, .jpg, .jpeg",
            'unique' => ":attribute sudah ada, silahkan masukkan :attribute lain",

        ];
        $this->validate($request, $rules, $messages);






        $this->new_puskesmas_item->puskesmas_id = $request->puskesmas_id;
        $this->new_puskesmas_item->poli_id = $request->poli_id;
        // $this->new_puskesmas_item->alamat = $request->alamat;


        $this->new_puskesmas_item->save();
        return redirect()->route('puskesmas')->with('status', 'Created Successfully ');
    }


    public function tambah()
    {

        // $supplier = $request->id;
        $category_show = puskesmas::all();
        $poli_show = poli::all();


        return view('puskesmas.tambah', [
            'dataPuskesmas' => $category_show,
            'dataPoli' => $poli_show
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function proses(Request $request)
    {
        $rules = [
            'kode_puskesmas' => "required|min:1|max:15|unique:tbl_puskesmas,kode_puskesmas",
            'nama' => "required|min:1|max:100|unique:tbl_puskesmas,nama",
            'alamat' => "required|min:1|max:200",
            // |exists:tbl_puskesmas,nama


        ];
        $messages = [
            'required' => "tidak boleh kosong",
            'min' => ":attribute karakter terlalu pendek",
            'max' => ":attribute karakter terlalu panjang / terlalu besar",
            'mimes' => ":attribute ekstensi error, gunakan .png, .jpg, .jpeg",
            'unique' => ":attribute sudah ada, silahkan masukkan :attribute lain",

        ];
        $this->validate($request, $rules, $messages);






        $this->new_puskesmas->kode_puskesmas = $request->kode_puskesmas;
        $this->new_puskesmas->nama = $request->nama;
        $this->new_puskesmas->alamat = $request->alamat;


        $this->new_puskesmas->save();
        return redirect()->route('puskesmas')->with('status', 'Created Successfully ');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\puskesmas  $puskesmas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-categories')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
        // $puskesmas_show = DB::table('tbl_puskesmas')
        //     ->select('*')
        //     ->where('id', '=', "$id");

        // $puskesmas_show = puskesmas::find($id);
        $puskesmas_show = puskesmas::find($id);

        $jumlah_pasien =  DB::table('categories')
            ->join('tbl_puskesmas_item', 'categories.puskesmas_id', '=', 'tbl_puskesmas_item.id')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
            ->select('tbl_puskesmas_item.puskesmas_id')
            ->where('tbl_puskesmas_item.puskesmas_id', '=', "$id")->get()
            ->count();

        $pasien_hari_ini =  DB::table('categories')
            ->join('tbl_puskesmas_item', 'categories.puskesmas_id', '=', 'tbl_puskesmas_item.id')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
            ->select('tbl_puskesmas_item.*', 'categories.*')
            ->where('tbl_puskesmas_item.puskesmas_id', '=', "$id")
            ->where('categories.tgl_kunjungan', '=', date('Y-m-d'))
            ->get()
            ->count();

        $tgl_kunjungan =   DB::table('categories')
            ->join('tbl_puskesmas_item', 'categories.puskesmas_id', '=', 'tbl_puskesmas_item.id')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
            ->select('tbl_puskesmas_item.puskesmas_id')
            ->where('tbl_puskesmas_item.puskesmas_id', '=', "$id")
            ->get();

        $pasien_minggu_ini = DB::table('categories')
            ->join('tbl_puskesmas_item', 'categories.puskesmas_id', '=', 'tbl_puskesmas_item.id')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
            ->select('*')
            ->where('tbl_puskesmas_item.puskesmas_id', '=', "$id")
            // ->where($tgl_kunjungan->weekOfYear, '=', "$id")
            // ->whereRaw('tgl_kunjungan >= DATE_SUB(CURRENT_DATE,INTERVAL 7 DAY)')
            ->whereRaw("WEEK(tgl_kunjungan,5) = WEEK(CURRENT_DATE,5)")
            // ->groupByRaw('YEARWEEK(tgl_kunjungan)')
            ->get()
            ->count();

        $pasien_bulan_ini = DB::table('categories')
            ->join('tbl_puskesmas_item', 'categories.puskesmas_id', '=', 'tbl_puskesmas_item.id')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
            ->select('*')
            ->where('tbl_puskesmas_item.puskesmas_id', '=', "$id")
            ->whereRaw("MONTH(tgl_kunjungan) = MONTH(CURRENT_DATE)")
            ->get()
            ->count();

        // $test = Carbon::now()->subWeek();

        // $now = Carbon::now();
        // echo $now->weekOfYear;

        // $now = Carbon::parse("01 Jan 2018");

        // dd($now->weekOfYear);
        // dd($now->weekNumberInMonth);
        // dd($pasien_minggu_ini);
        // die;

        // $poli_id = $puskesmas_show->poli_id;
        // $puskesmas_id = $puskesmas_show->puskesmas_id;

        $puskesmas_item_show = puskesmas_item::find($id);
        // dd($jumlah_pasien);
        // die;
        // $poli_show = poli::find($poli_id);

        $poli_show = DB::table('tbl_puskesmas_item')
            ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
            ->select('tbl_puskesmas_item.*', 'tbl_poli.*', 'tbl_puskesmas_item.id as id_poli_item')
            ->where('tbl_puskesmas_item.puskesmas_id', '=', "$id")->get();


        // $data =  DB::table('tbl_puskesmas_item')
        //     ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
        //     ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
        //     ->select('tbl_puskesmas.*', 'tbl_poli.*', 'tbl_puskesmas_item.*')
        //     ->where('tbl_puskesmas_item.id', 'LIKE', "%$id%");

        return view('puskesmas.show', [
            'showPuskesmas' => $puskesmas_show,
            'showPoli' => $poli_show,
            'showPuskesmasItem' => $puskesmas_item_show,
            'jmlhPasien' => $jumlah_pasien,
            'pasienHariIni' => $pasien_hari_ini,
            'pasienMingguIni' => $pasien_minggu_ini,
            'pasienBulanIni' => $pasien_bulan_ini
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\puskesmas  $puskesmas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-categories')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });

        $join_puskesmas = DB::table('tbl_puskesmas')
            ->join('users', 'users.id', '=', 'tbl_puskesmas.admin_id')
            ->where('tbl_puskesmas.id', 'LIKE', $id)
            ->first();

        $users = User::all()->where('roles', '=', '["STAFF"]');
        // var_dump($users);
        // die;

        $puskesmas_edit = puskesmas::find($id);
        return view('puskesmas.edit', [
            'dataPuskesmas' => $puskesmas_edit,
            'joinPuskesmas' => $join_puskesmas,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\puskesmas  $puskesmas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'admin_id' => "unique:tbl_puskesmas,admin_id|nullable"



        ];
        $messages = [
            'unique' => ":attribute sudah terdaftar di puskesmas lain, silahkan pilih :attribute lain",

        ];
        $this->validate($request, $rules, $messages);

        $puskesmas_edit = puskesmas::find($id);
        $puskesmas_edit->kode_puskesmas = $request->kode_puskesmas;
        $puskesmas_edit->nama = $request->nama;
        $puskesmas_edit->alamat = $request->alamat;
        $puskesmas_edit->admin_id = $request->admin_id;



        $puskesmas_edit->save();
        return redirect()->route('puskesmas')->with('status', 'Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\puskesmas  $puskesmas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $puskesmas_id = puskesmas::where('admin_id', '=', $id)->first();

        $data_poli = poli::where('puskesmas_id', '=', $id);
        $data_pegawai = DB::table('pegawai')->where('puskesmas_id', '=', $id);
        $data_obat = DB::table('tbl_obat')->where('puskesmas_id', '=', $id);
        $data_suplai = DB::table('tbl_suplai')->where('puskesmas_id', '=', $id);
        $data_pemasukan_obat = DB::table('tbl_pemasukan_obat')->where('puskesmas_id', '=', $id);
        $data_puskesmas_item = DB::table('tbl_puskesmas_item')->where('puskesmas_id', '=', $id);
        $data_dokter = DB::table('tbl_dokter')->where('puskesmas_id', '=', $id);
        $data_jadwal_dokter = DB::table('tbl_jadwal_dokter')->where('puskesmas_id', '=', $id);
        // dd($data_poli);

        $puskesmas_hapus = puskesmas::findOrFail($id);
        // $puskesmas_hapus = puskesmas::find($id);

        // dd($puskesmas_hapus->admin_id);
        $id_user = Auth::user()->id;

        if ($puskesmas_hapus->admin_id != null) {
            $puskesmas_hapus->admin_id = null;

            $puskesmas_hapus->save();
        }

        if (Auth::user()->roles == '["STAFF"]') {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        } else if (Auth::user()->roles == '["ADMIN"]') {
            $data_puskesmas_item->delete();
            $data_suplai->delete();
            $data_pemasukan_obat->delete();
            $data_obat->delete();
            $data_poli->delete();
            $data_pegawai->delete();
            $data_dokter->delete();
            $data_jadwal_dokter->delete();
            $puskesmas_hapus->delete();

            return redirect()->route('puskesmas')->with('status', 'Data berhasil dihapus');
        }
    }

    public function delete($id)
    {

        $puskesmas_hapus = puskesmas_item::findOrFail($id);
        // dd($puskesmas_hapus);
        $puskesmas_hapus->delete();


        return redirect()->route('puskesmas')->with('status', 'Data berhasil dihapus');
    }
}
