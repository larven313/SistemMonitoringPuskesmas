<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\poli;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class AntriController extends Controller
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
    }
    public function index(Request $request)
    {

        $jumlah = Category::where('status_antrian', 'LIKE', "Antri")->count();


        $batas = 5;
        $data = Category::simplePaginate($batas);


        $no = $batas * ($data->currentPage() - 1);


        $name = $request->nama;

        $poli = poli::all();





        // query tampil berdasarkan request nama
        $data = Category::where('status_antrian', 'LIKE', "Antri")->simplePaginate($batas);

        // passing ke view
        return view('welcome', [
            'data' => $data,
            'totalData' => $jumlah,
            'namaPoli' => $poli,
            'no' => $no
        ]);
    }
    public function welcome(Request $request)
    {

        $jumlah = Category::where('status_antrian', 'LIKE', "Antri")->count();


        $batas = 5;
        $data = Category::simplePaginate($batas);


        $no = $batas * ($data->currentPage() - 1);


        $name = $request->nama;

        $poli = poli::all();
        $puskesmas = DB::table('tbl_puskesmas_item')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
            ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
            ->select('tbl_puskesmas_item.*', 'tbl_puskesmas.nama', 'tbl_poli.nama_poli')
            ->orderBy('tbl_puskesmas_item.puskesmas_id')
            ->get();


        // query tampil berdasarkan request nama
        $data = Category::where('status_antrian', 'LIKE', "Antri")->simplePaginate($batas);

        // passing ke view
        return view('welcome', [
            'data' => $data,
            'totalData' => $jumlah,
            'no' => $no,
            'puskesmas' => $puskesmas,
            'namaPoli' => $poli
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $puskesmas = DB::table('tbl_puskesmas_item')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', '=', 'tbl_puskesmas.id')
            ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', '=', 'tbl_poli.id')
            ->select('tbl_puskesmas_item.*', 'tbl_puskesmas.nama', 'tbl_poli.nama_poli')
            ->orderBy('tbl_puskesmas_item.puskesmas_id')
            ->get();

        $max = Category::max('no_antrian');
        $max++;
        return view('welcome', [
            'max' => $max,
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
            'nama' => "required|min:5|max:20|unique:categories,nama", //unique : nama_tabel, nama_kolom
            'image' => "required|max:55000|mimes:png,jpeg,jpg",
            'nik' => "required",
            'gender' => "required",
            'poli_id' => "required",
            'status_antrian' => "required",
            'status_bayar' => 'required',
            'no_bpjs' => 'required'
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

        $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();

        $this->new_category->nik = $request->nik;
        // $this->new_category->no_antrian++;
        $this->new_category->nama = $request->nama;
        $this->new_category->no_antrian = $request->no_antrian;
        $this->new_category->gender = $request->gender;
        $this->new_category->alamat = $request->alamat;
        $this->new_category->tgl_kunjungan = $request->tgl_kunjungan;
        $this->new_category->puskesmas_id = $request->puskesmas_id;
        $this->new_category->status_bayar = $request->status_bayar;
        $this->new_category->status_antrian = $request->status_antrian;
        $this->new_category->no_bpjs = $request->no_bpjs;
        $this->new_category->keterangan = $request->keterangan;


        $this->new_category->image = $namaFile;

        $nm->move(public_path() . '/img', $namaFile);
        $this->new_category->slug = Str::slug($request->nama, '-');
        $this->new_category->save();
        return redirect()->route('welcome')->with('status', 'Data Berhasil dibuat ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category_show = Category::find($id);
        return view(
            'print',
            [
                'showKategori' => $category_show

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
        $category_edit = Category::find($id);
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
     * @param  int  $id
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
