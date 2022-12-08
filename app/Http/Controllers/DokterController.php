<?php

namespace App\Http\Controllers;

use App\Models\dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $new_dokter;
    public function __construct()
    {
        $this->new_dokter = new dokter();

        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-categories')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    public function index(Request $request)
    {

        $batas = 5;
        $data = dokter::simplePaginate($batas);

        $nomor = $batas * ($data->currentPage() - 1);

        $name = $request->nama_dokter;
        $id_user = Auth::user()->id;

        $jumlah = dokter::join('tbl_puskesmas', 'tbl_puskesmas.id', 'tbl_dokter.puskesmas_id')
            ->select('tbl_puskesmas.*', 'tbl_dokter.*')
            ->where('admin_id', 'LIKE', $id_user)
            ->get()
            ->count();

        $data = dokter::join('tbl_puskesmas', 'tbl_puskesmas.id', 'tbl_dokter.puskesmas_id')
            ->select('tbl_puskesmas.*', 'tbl_dokter.*')
            ->where('admin_id', 'LIKE', $id_user)
            ->where('nama_dokter', 'LIKE', "%$name%")->simplePaginate($batas);

        return view('dokter.index', [
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

        return view('dokter.create', [
            'puskesmas' => $data,
            '$puskesmas_admin' => $data_admin
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
            'kode_dokter' => "required|min:2|max:20",
            'nama_dokter' => "required|max:100",
            'alamat' => "required|min:3|max:100",
            'gender' => "required",
            'no_induk' => "required"

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
        $this->new_dokter->nama_dokter = $request->nama_dokter;
        $this->new_dokter->kode_dokter = $request->kode_dokter;
        $this->new_dokter->alamat = $request->alamat;
        $this->new_dokter->gender = $request->gender;
        $this->new_dokter->no_induk = $request->no_induk;
        $this->new_dokter->tgl_lahir = $request->tgl_lahir;
        $this->new_dokter->tmpt_lahir = $request->tmpt_lahir;
        $this->new_dokter->puskesmas_id = $request->puskesmas_id;



        $this->new_dokter->image = $namaFile;

        $nm->move(public_path() . '/img', $namaFile);
        $this->new_dokter->slug = Str::slug($request->nama_dokter, '-');
        $this->new_dokter->save();
        return redirect()->route('dokter')->with('status', 'Data Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokter_show = dokter::find($id);

        return view('dokter.show', [
            'showDokter' => $dokter_show
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = dokter::all();
        $dokter_edit = dokter::find($id);
        return view(
            'dokter.edit',
            [
                'dataDokter' => $dokter_edit,
                'datas' => $datas
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dokter_edit = dokter::find($id);
        $dokter_edit->nama_dokter = $request->nama_dokter;
        $dokter_edit->kode_dokter = $request->kode_dokter;
        $dokter_edit->alamat = $request->alamat;
        $dokter_edit->gender = $request->gender;
        $dokter_edit->tmpt_lahir = $request->tmpt_lahir;
        $dokter_edit->tgl_lahir = $request->tgl_lahir;
        $dokter_edit->no_induk = $request->no_induk;
        // $dokter_edit->image = $request->image;



        $gambarLama = $dokter_edit->image;
        $dokter_edit->slug = Str::slug($request->nama_dokter, '-');

        if (!$request->image) {
            $dokter_edit->image = $gambarLama;
        } else {

            // update gambar baru
            if ($request->image != $gambarLama) {


                $nm = $request->image;
                $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
                $dokter_edit->image = $namaFile;

                $nm->move(public_path() . '/img', $namaFile);
            } else {
                $request->image->move(public_path() . '/img', $gambarLama);
            }
        }

        $dokter_edit->save();
        return redirect()->route('dokter')->with('status', 'Updated Successfully ');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dokter_hapus = dokter::findOrFail($id); //bila dicari dan  error maka akan ditampilkan 404 not found
        $image_path = "img/" . $dokter_hapus->image;

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $dokter_hapus->delete();
        return redirect()->route('dokter')->with('status', 'Data Berhasil Dihapus');
    }
}
