<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\puskesmas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
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

        //gunakan middleware untuk cek Gate Authorize User nya
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-categories')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        // return view('kategori.index');
        // $data = new Category();
        // $data->all();

        // cek total data
        // var_dump($jumlah);

        // menampilkan seluruh data
        // $data = Category::all();

        // buat pagination opsi 1
        $batas = 5;
        $data = Category::simplePaginate($batas);

        // buat pagination opsi 2
        // $data = Category::simplePaginate(5);

        // urutkan nomor sesuai total data
        $no = $batas * ($data->currentPage() - 1);

        // Cari berdasarkan nama
        // tangkap request nama
        $name = $request->nama;
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $id_puskesmas = $request->id_puskesmas;

        // var_dump($name);

        // buat validasi request name
        // TO DO
        $id_user = Auth::user()->id;

        // $puskesmas = DB::table('tbl_puskesmas')->select('*');


        // query tampil berdasarkan request nama
        if (Auth::user()->roles == '["STAFF"]') {
            if ($tgl_awal && $tgl_akhir != null) {
                $data = DB::table('categories')
                    ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                    ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                    ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                    ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                    ->where('categories.nama', 'LIKE', "%$name%")
                    ->where('admin_id', 'LIKE', $id_user)
                    ->WhereBetween('categories.tgl_kunjungan', [$tgl_awal, $tgl_akhir])
                    ->simplePaginate($batas);

                $jumlah = DB::table('categories')
                    ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                    ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                    ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                    ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                    ->where('categories.nama', 'LIKE', "%$name%")
                    ->where('admin_id', 'LIKE', $id_user)
                    ->WhereBetween('categories.tgl_kunjungan', [$tgl_awal, $tgl_akhir])
                    ->get()
                    ->count();
            } else {
                $data = DB::table('categories')
                    ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                    ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                    ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                    ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                    ->where('categories.nama', 'LIKE', "%$name%")
                    ->where('admin_id', 'LIKE', $id_user)
                    ->simplePaginate($batas);

                $jumlah = DB::table('categories')
                    ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                    ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                    ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                    ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                    ->where('categories.nama', 'LIKE', "%$name%")
                    ->where('admin_id', 'LIKE', $id_user)
                    ->get()
                    ->count();
            }
        } else {

            if ($tgl_awal && $tgl_akhir != null) {
                $data = DB::table('categories')
                    ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                    ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                    ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                    ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                    ->where('categories.nama', 'LIKE', "%$name%")
                    ->where('tbl_puskesmas.id', 'LIKE', $id_puskesmas)
                    ->WhereBetween('categories.tgl_kunjungan', [$tgl_awal, $tgl_akhir])
                    ->simplePaginate($batas);

                $jumlah = DB::table('categories')
                    ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                    ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                    ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                    ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                    ->where('tbl_puskesmas.id', 'LIKE', $id_puskesmas)
                    ->WhereBetween('categories.tgl_kunjungan', [$tgl_awal, $tgl_akhir])
                    ->count();
            } else {
                $data = DB::table('categories')
                    ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                    ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                    ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                    ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                    ->where('categories.nama', 'LIKE', "%$name%")
                    ->simplePaginate($batas);

                $jumlah = Category::count();
            }
        }



        // passing ke view
        return view('kategori.index', [
            'data' => $data,
            'totalData' => $jumlah,
            'no' => $no,
        ]);
    }
    // public function cari(Request $request)
    // {
    //     $name = $request->nama;
    //     var_dump($name);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $id_user = Auth::user()->id;

        if (Auth::user()->roles == '["STAFF"]') {
            $puskesmas = DB::table('tbl_puskesmas_item')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
                ->select('tbl_puskesmas_item.*', 'tbl_puskesmas.nama', 'tbl_poli.nama_poli')
                ->where('admin_id', 'LIKE', $id_user)
                ->orderBy('tbl_puskesmas_item.puskesmas_id')
                ->get();
        } else {
            $puskesmas = DB::table('tbl_puskesmas_item')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
                ->select('tbl_puskesmas_item.*', 'tbl_puskesmas.nama', 'tbl_poli.nama_poli')
                ->orderBy('tbl_puskesmas_item.puskesmas_id')
                ->get();
        }

        $id_puskesmas = DB::table('tbl_puskesmas')
            ->join('users', 'users.id', 'tbl_puskesmas.admin_id')
            ->select('tbl_puskesmas.*', 'users.*', 'tbl_puskesmas.id as id_puskesmas')
            ->where('users.id', 'LIKE', $id_user)
            ->first();

        // dd($id_puskesmas);


        $max = Category::max('no_antrian');
        $max++;

        // dd($puskesmas);

        return view('kategori.create', [
            'max' => $max,
            'puskesmas' => $puskesmas,
            'id_puskesmas' => $id_puskesmas,

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
        // die & var_dump()
        // dd($request->all());

        // ======================================
        // lakukan validasi
        // ======================================
        // opsi 1
        // $validate = validator::make($request->all(), [
        //     // required = field input harus di isi, min = minimal karakter 5 dan maks = 20
        //     'nama' => "required|min:5|max:20",
        //     'image' => "required|max:500|mimes:png,jpeg,jpg"
        // ])->validate();

        // custom error message
        // opsi 2
        // $request->validate([
        //     'nama' => "required|min:5|max:20",
        //     'image' => "required|max:500|mimes:png,jpeg,jpg"
        // ], [
        //     'nama.required' => ":attribute harus di isi",
        //     'nama.min' => ":attribute tidak boleh kurang dari 5 karakter",
        //     'nama.max' => ":attribute tidak boleh lebih dari 20 karakter"
        // ]);

        // opsi 3
        $rules = [
            'nama' => "required|min:4|max:20|unique:categories,nama", //unique : nama_tabel, nama_kolom
            'image' => "required|max:55000|mimes:png,jpeg,jpg"
        ];
        $messages = [
            'required' => ":attribute tidak boleh kosong",
            'min' => ":attribute karakter terlalu pendek",
            'max' => ":attribute karakter terlalu panjang / terlalu besar",
            'mimes' => ":attribute ekstensi error, gunakan .png, .jpg, .jpeg",
            'unique' => ":attribute sudah ada, silahkan masukkan :attribute lain"
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
        $jam_kunjungan = $request->input('jam_kunjungan');
        $puskesmas_id = $request->input('puskesmas_id');
        $status_bayar = $request->input('status_bayar');
        $status_antrian = $request->input('status_antrian');
        $no_bpjs = $request->input('no_bpjs');
        $image = $request->input('image');

        $maximal = Category::where('puskesmas_id', '=', $puskesmas_id)->max('no_antrian');
        $max = $maximal + 1;

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
        $this->new_category->jam_kunjungan = $request->jam_kunjungan;
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
        return redirect()->route('categories', [
            'nama' => $nama,
            'max' => $max,
            'gender' => $gender,
            'alamat' => $alamat,
            'tgl_kunjungan' => $tgl_kunjungan,
            'jam_kunjungan' => $jam_kunjungan,
            'poli_id' => $puskesmas,
            'status_bayar' => $status_bayar,
            'status_antrian' => $status_antrian,
            'no_bpjs' => $no_bpjs,
            'nik' => $nik,
            'id' => $id,
            'image' => $image,


        ])->with('status', 'Data Berhasil Dibuat');
        // return redirect()->route('categories')->with('status', 'Data Berhasil dibuat ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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

        $puskesmas = DB::table('categories')
            ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
            ->select('categories.*', 'tbl_puskesmas.nama')
            ->where('categories.id', 'LIKE', $id)
            ->first();

        $category_show = Category::find($id);
        $max = Category::max('no_antrian');
        $max++;
        return view(
            'kategori.show',
            [
                'showKategori' => $data,
                'max' => $max,
                'showPuskesmas' => $puskesmas

            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dapatkan data berdasarkan id kategori 
        $category_edit = Category::find($id);
        $datas = Category::all();

        $data = DB::table('categories')
            ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
            ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
            ->select('categories.*', 'tbl_poli.nama_poli')
            ->where('categories.id', 'LIKE', $id)
            ->first();

        $puskesmas_id = $data->puskesmas_id;

        $id_user = Auth::user()->id;

        $obat = DB::table('tbl_obat')
            ->join('tbl_puskesmas', 'tbl_puskesmas.id', '=', 'tbl_obat.puskesmas_id')
            ->select('tbl_obat.*', 'tbl_puskesmas.*', 'tbl_obat.id as id_obat')
            ->where('admin_id', '=', $id_user)->get();
        // dd($obat);



        $nama_puskesmas = DB::table('tbl_puskesmas_item')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
            ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
            ->select('tbl_puskesmas_item.*', 'tbl_puskesmas.nama', 'tbl_poli.nama_poli')
            ->get();

        $puskesmas = DB::table('tbl_puskesmas_item')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
            ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
            ->select('tbl_puskesmas_item.*', 'tbl_puskesmas.nama', 'tbl_poli.nama_poli')
            ->where('tbl_puskesmas_item.id', 'LIKE', $puskesmas_id)
            ->get();

        // dd($puskesmas);
        // debuging opsi 1
        // var_dump($data);

        // debuging opsi 1
        // print_r($puskesmas_id);

        // passing ke view
        return view(
            'kategori.edit',
            [
                'dataCategory' => $data,
                'datas' => $datas,
                'puskesmas' => $puskesmas,
                'dataPuskesmas' => $nama_puskesmas,
                'dataObat' => $obat
            ]
        );
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
        // update categories SET name="?", image="?" where id="?";
        $category_edit = Category::find($id);
        $category_edit->nik = $request->nik;
        // $category_edit->no_antrian++;
        $category_edit->nama = $request->nama;
        $category_edit->no_antrian = $request->no_antrian;
        $category_edit->gender = $request->gender;
        $category_edit->alamat = $request->alamat;
        $category_edit->puskesmas_id = $request->puskesmas_id;
        $category_edit->status_bayar = $request->status_bayar;
        $category_edit->status_antrian = $request->status_antrian;
        $category_edit->no_bpjs = $request->no_bpjs;
        $category_edit->keterangan = $request->keterangan;
        $category_edit->jam_kunjungan = $request->jam_kunjungan;
        $category_edit->obat_id = $request->obat_id;

        $gambarLama = $category_edit->image;

        $tgl_lama = $category_edit->tgl_kunjungan;

        if (!$request->tgl_kunjungan) {
            $category_edit->tgl_kunjungan = $tgl_lama;
        } else {
            $category_edit->tgl_kunjungan = $request->tgl_kunjungan;
        }


        $category_edit->slug = Str::slug($request->nama, '-');
        if (!$request->image) {
            $category_edit->image = $gambarLama;
        } else {

            // update gambar baru
            if ($request->image != $gambarLama) {


                $nm = $request->image;
                $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
                $category_edit->image = $namaFile;

                $nm->move(public_path() . '/img', $namaFile);
            } else {
                $request->image->move(public_path() . '/img', $gambarLama);
            }
        }

        $category_edit->save();
        return redirect()->route('categories')->with('status', 'Data Berhasil Diubah | Pindah ke Data Pasien');
        // $category_edit->image = $request->image;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category_hapus = Category::findOrFail($id); //bila dicari dan  error maka akan ditampilkan 404 not found
        $image_path = "img/" . $category_hapus->image;

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $category_hapus->delete();
        return redirect()->route('categories')->with('status', 'Data Berhasil Dihapus | Pindah ke Data Pasien');
    }
}
