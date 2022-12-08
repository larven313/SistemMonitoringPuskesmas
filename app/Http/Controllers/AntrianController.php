<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\puskesmas;
use App\Models\poli;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $new_category;
    public function __construct()
    {
        $this->new_category = new Category();
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-guest')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    public function index(Request $request)
    {



        $batas = 5;
        $data = Category::simplePaginate($batas);


        $no = $batas * ($data->currentPage() - 1);
        $id_user = Auth::user()->id;


        $name = $request->nama;
        // $poli = poli::all();

        $puskesmas_all = DB::table("tbl_puskesmas")
            ->where('tbl_puskesmas.admin_id', 'LIKE', $id_user)
            ->get();

        // dd($puskesmas_all);


        $poli_id = $request->poli;
        $poli = DB::table("tbl_puskesmas_item")
            ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
            ->select('tbl_poli.id as id_poli', 'tbl_poli.nama_poli')
            ->where('tbl_puskesmas.admin_id', 'LIKE', $id_user)
            ->get();
        // dd($poli_id);
        $name = $request->nama;

        // query tampil berdasarkan request antri
        // $data = Category::where('status_antrian', 'LIKE', "Antri")->simplePaginate($batas);
        if (Auth::user()->roles == '["STAFF"]') {

            if ($poli_id != null) {
                $data = DB::table('categories')
                    ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                    ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                    ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                    ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                    ->where('categories.status_antrian', '!=', "Selesai")
                    ->where('categories.nama', 'LIKE', "%$name%")
                    ->where('tbl_puskesmas_item.poli_id', 'LIKE', "$poli")
                    ->where('admin_id', 'LIKE', $id_user)
                    ->orderBy('categories.no_antrian')
                    ->simplePaginate($batas);
            } else {
                $data = DB::table('categories')
                    ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                    ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                    ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                    ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                    ->where('categories.status_antrian', '!=', "Selesai")
                    ->where('categories.nama', 'LIKE', "%$name%")
                    ->where('admin_id', 'LIKE', $id_user)
                    ->orderBy('categories.no_antrian')
                    ->where('categories.nama', 'LIKE', "%$name%")
                    ->simplePaginate($batas);
            }


            // $jumlah = Category::where('status_antrian', 'LIKE', "Antri")
            //     ->where('admin_id', 'LIKE', $id_user)
            //     ->count();
            $jumlah = DB::table('categories')
                ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('categories.status_antrian', '!=', "Selesai")
                ->where('admin_id', 'LIKE', $id_user)->get()->count();
        } else {
            if ($poli_id != null) {

                $data = DB::table('categories')
                    ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                    ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                    ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                    ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                    ->where('categories.status_antrian', '!=', "Selesai")
                    ->where('categories.nama', 'LIKE', "%$name%")
                    ->where('tbl_puskesmas_item.poli_id', 'LIKE', "$poli_id")
                    ->simplePaginate($batas);
            } else {
                $data = DB::table('categories')
                    ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                    ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                    ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                    ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                    ->where('categories.status_antrian', '!=', "Selesai")
                    ->where('categories.nama', 'LIKE', "%$name%")

                    ->simplePaginate($batas);
            }


            $jumlah = Category::where('status_antrian', 'LIKE', "Antri")->count();
        }
        // dd($data);

        // passing ke view
        return view('antrian.index', [
            'data' => $data,
            'totalData' => $jumlah,
            'no' => $no,
            'poli' => $poli
        ]);
    }

    public function welcome(Request $request)
    {

        $jumlah = Category::where('status_antrian', 'LIKE', "Antri")->count();


        $batas = 5;
        $data = Category::simplePaginate($batas);


        $no = $batas * ($data->currentPage() - 1);


        $name = $request->nama;





        // query tampil berdasarkan request nama
        $data = Category::where('status_antrian', 'LIKE', "Antri")->simplePaginate($batas);

        // passing ke view
        return view('welcome', [
            'data' => $data,
            'totalData' => $jumlah,
            'no' => $no
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // if (condition) {
        //     # code...
        // } else {
        //     # code...
        // }

        $max = Category::max('no_antrian');
        $maximal = $max + 1;
        $id = $request->id;
        $antrian_show = Category::find($id);

        // dd($no_antrian_skrng);

        return view('print', [
            'max' => $max,
            'showAntrian' => $maximal
        ])->with('status', 'Data Berhasil dibuat ');
        // return redirect('/index/print', [
        //     'showAntrian' => $antrian_show
        // ]);
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
            'nama' => "required|min:4|max:20|unique:categories,nama", //unique : nama_tabel, nama_kolom
            'image' => "required|max:55000|mimes:png,jpeg,jpg",
            'puskesmas_id' => "required",
            'nik' => "required|unique:categories,nik",
            'no_bpjs' => $request->status_bayar == "Bayar" ? "" : "unique:categories,no_bpjs",

        ];
        $messages = [
            'required' => ":attribute tidak boleh kosong",
            'min' => ":attribute karakter terlalu pendek",
            'max' => ":attribute karakter terlalu panjang / terlalu besar",
            'mimes' => ":attribute ekstensi error, gunakan .png, .jpg, .jpeg",
            'unique' => ":attribute sudah ada, silahkan masukkan :attribute lain",
            'numeric' => ":attribute harus angka !"
        ];
        $this->validate($request, $rules, $messages);

        $nm = $request->image;

        $nama = $request->input('nama');
        $nik = $request->input('nik');
        $id = $request->input('id');

        // $no_antrian = $request->input('no_antrian');

        $gender = $request->input('gender');
        $alamat = $request->input('alamat');
        $tgl_kunjungan = $request->input('tgl_kunjungan');
        $puskesmas_id = $request->input('puskesmas_id');
        $status_bayar = $request->input('status_bayar');
        $status_antrian = $request->input('status_antrian');



        if ($request->input('no_bpjs') == null) {
            $no_bpjs = 0;
        } else {
            $no_bpjs = $request->input('no_bpjs');
        }
        $image = $request->input('image');


        $tgl_skrng = Carbon::now()->isoFormat('Y-MM-DD');
        // $max  = null;
        $data_puskesmas = Category::where('puskesmas_id', '=', $puskesmas_id)->first();

        // $antrian_sekarang = Category::all()->where('puskesmas_id', '=', $puskesmas_id)
        //     ->where('tgl_kunjungan', '=', $tgl_kunjungan)
        //     ->max('no_antrian');
        $antrian_sekarang = Category::where('tgl_kunjungan', '=', $tgl_skrng)->where('puskesmas_id', '=', $puskesmas_id)->get();
        $index_pasien = Category::where('tgl_kunjungan', '=', $tgl_skrng)->where('puskesmas_id', '=', $puskesmas_id)->count();
        if ($index_pasien != null) {
            $index_pasien -= 1;
        } else {
            $index_pasien = null;
        }



        // foreach ($antrian_sekarang as $objek) {
        //     # code...
        // }
        // $index_pasien = Category::where('puskesmas_id', '=', $puskesmas_id)->count();

        // dd($antrian_sekarang[$index_pasien]->nama);
        // dd($antrian_sekarang[$index_pasien]->nama);
        // masih dicoba / coba cek
        if ($tgl_kunjungan == $tgl_skrng) {

            if ($index_pasien == null) {

                // dd('index pasien kosong');
                $max = 1;
            } else {
                // dd($antrian_sekarang[$index_pasien]->no_antrian);

                $maximal = Category::where('puskesmas_id', '=', $puskesmas_id)->max('no_antrian');
                $max = $maximal + 1;
            }
        } else if ($tgl_kunjungan != $tgl_skrng) {

            if ($tgl_kunjungan > $tgl_skrng) {

                $data_puskesmas2 = Category::where('puskesmas_id', '=', $puskesmas_id)->first();

                if ($data_puskesmas2 == $tgl_kunjungan) {
                    $maximal = Category::where('puskesmas_id', '=', $puskesmas_id)->max('no_antrian');
                    $max = $maximal + 1;
                } else {
                    $max = 1;
                }

                $maximal = Category::where('puskesmas_id', '=', $puskesmas_id)->max('no_antrian');


                $max = 1;
            } else {
                $data_puskesmas2 = Category::where('puskesmas_id', '=', $puskesmas_id)->first();

                if ($data_puskesmas2 = $tgl_kunjungan) {
                    $maximal = Category::where('puskesmas_id', '=', $puskesmas_id)->max('no_antrian');
                    $max = $maximal + 1;
                } else {
                    $max = 1;
                }
            }
        }
        // dd($max);


        $puskesmas = DB::table('tbl_puskesmas_item')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
            ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
            ->select('tbl_puskesmas_item.*', 'tbl_puskesmas.nama', 'tbl_poli.nama_poli')
            ->where('tbl_puskesmas_item.id', '=', $puskesmas_id)
            ->get();


        $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();

        $this->new_category->nik = $request->nik;
        // $this->new_category->no_antrian++;
        $this->new_category->nama = $request->nama;
        $this->new_category->no_antrian = $max;
        $this->new_category->gender = $request->gender;
        $this->new_category->alamat = $request->alamat;
        $this->new_category->tgl_kunjungan = $request->tgl_kunjungan;
        $this->new_category->puskesmas_id = $request->puskesmas_id;
        $this->new_category->user_id = $request->user_id; //tambah ini
        $this->new_category->status_bayar = $request->status_bayar;
        $this->new_category->status_antrian = $request->status_antrian;
        $this->new_category->no_bpjs = $request->no_bpjs;
        $this->new_category->keterangan = $request->keterangan;


        $this->new_category->image = $namaFile;

        $nm->move(public_path() . '/img', $namaFile);
        $this->new_category->slug = Str::slug($request->nama, '-');
        $this->new_category->save();
        // return redirect()->route('print')->with('status', 'Data Berhasil dibuat ');
        // return "Nama : $nama";
        return view('print', [
            'nama' => $nama,
            'max' => $max,
            'gender' => $gender,
            'alamat' => $alamat,
            'tgl_kunjungan' => $tgl_kunjungan,
            'poli_id' => $puskesmas,
            'status_bayar' => $status_bayar,
            'status_antrian' => $status_antrian,
            'no_bpjs' => $no_bpjs,
            'nik' => $nik,
            'id' => $id,
            'image' => $image,


        ])->with('status', 'Data Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {



        $jumlah = Category::where('user_id', 'LIKE', $id)->count();
        $jmlh_antrian = Category::where('status_antrian', 'LIKE', 'Antri')->count();


        $batas = 10;
        $data = Category::simplePaginate($batas);

        $data = Category::where('status_antrian', 'LIKE', "Antri")->simplePaginate($batas);
        $no = $batas * ($data->currentPage() - 1);

        // $antrianShow = Category::find($id);
        // $max = $maximal + 1;
        return view(
            'antrian.show',
            [
                'data' => $data,
                'totalData' => $jumlah,
                'jmlhAntrian' => $jmlh_antrian,
                'no' => $no

            ]
        );
    }

    public function daftar_antrian(Request $request)
    {



        $id = Auth::user()->id;
        $jumlah = Category::where('user_id', 'LIKE', $id)->count();
        $jmlh_antrian = Category::where('status_antrian', 'LIKE', 'Antri')->count();


        $batas = 10;
        $data = Category::simplePaginate($batas);

        $puskesmas = DB::table('tbl_puskesmas')
            ->select('id')
            ->get();

        // var_dump($puskesmas);
        // $data = Category::where('status_antrian', 'LIKE', "Antri")->simplePaginate($batas);
        // $data = DB::table('categories')
        //     ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
        //     ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
        //     ->select('categories.*', 'tbl_poli.nama_poli')
        //     ->where('categories.status_antrian', 'LIKE', "Antri")->simplePaginate($batas);

        $data = DB::table('categories')
            ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
            ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
            ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
            ->where('categories.status_antrian', 'LIKE', "Antri")
            ->orderBy('tbl_puskesmas.nama', 'asc')
            ->simplePaginate($batas);
        // ->where('tbl_puskesmas.id', 'LIKE', "1")
        $no = $batas * ($data->currentPage() - 1);

        // $antrianShow = Category::find($id);
        // $max = $maximal + 1;
        // redirect()->
        return view(
            'antrian.show',
            [
                'data' => $data,
                'totalData' => $jumlah,
                'jmlhAntrian' => $jmlh_antrian,
                'no' => $no
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {



        $category_edit = Category::where('status_antrian', 'LIKE', "Antri");
        $datas = Category::all();

        return view(
            'antrian.edit',
            [
                'dataCategory' => $category_edit,
                'datas' => $datas
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {



        $category_edit = Category::find($id);
        $category_edit->status_antrian = "Selesai";

        $category_edit->save();
        return redirect()->route('antrian')->with('status', 'Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
