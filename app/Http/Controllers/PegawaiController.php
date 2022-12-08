<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use App\Models\puskesmas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $new_pegawai;
    public function __construct()
    {
        $this->new_pegawai = new pegawai();

        //gunakan middleware untuk cek Gate Authorize User nya
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-categories')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {



        $batas = 5;
        $data = pegawai::simplePaginate($batas);

        $no = $batas * ($data->currentPage() - 1);
        $name = $request->nama;

        $id_user = Auth::user()->id;

        $jumlah = pegawai::join('tbl_puskesmas', 'tbl_puskesmas.id', '=', 'pegawai.puskesmas_id')
            ->where('tbl_puskesmas.admin_id', 'LIKE', $id_user)
            ->get()
            ->count();


        $data = pegawai::join('tbl_puskesmas', 'tbl_puskesmas.id', '=', 'pegawai.puskesmas_id')
            ->where('pegawai.nama', 'LIKE', "%$name%")
            ->where('tbl_puskesmas.admin_id', 'LIKE', $id_user)
            ->select('tbl_puskesmas.*', 'pegawai.*', 'tbl_puskesmas.nama as nama_puskesmas', 'pegawai.id as id_pegawai')
            ->simplePaginate($batas);

        return view('pegawai.index', [
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
    public function create()
    {
        $data = DB::table('tbl_puskesmas')
            ->select('*')->get();

        // var_dump($data);
        // die;
        $id_user = Auth::user()->id;

        $id_puskesmas = DB::table('tbl_puskesmas')
            ->join('users', 'users.id', 'tbl_puskesmas.admin_id')
            ->select('tbl_puskesmas.*', 'users.*', 'tbl_puskesmas.id as id_puskesmas')
            ->where('users.id', 'LIKE', $id_user)
            ->get();

        // dd($id_puskesmas);

        return view('pegawai.create', [
            'puskesmas' => $data,
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
            'nama' => "required|min:5|max:20|unique:pegawai,nama", //unique : nama_tabel, nama_kolom
            'avatar' => "required|max:55000|mimes:png,jpeg,jpg",
            'npwp' => "required|min:3|max:15", //unique : nama_tabel, nama_kolom
            'gender' => "required",
            'jabatan' => "required",
            'bidang' => "required"




        ];
        $messages = [
            'required' => ":attribute tidak boleh kosong",
            'min' => ":attribute karakter terlalu pendek",
            'max' => ":attribute karakter terlalu panjang / terlalu besar",
            'mimes' => ":attribute ekstensi error, gunakan .png, .jpg, .jpeg",
            'unique' => ":attribute sudah ada, silahkan masukkan :attribute lain"
        ];
        $this->validate($request, $rules, $messages);


        $nm = $request->avatar;

        $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
        $this->new_pegawai->nama = $request->nama;
        $this->new_pegawai->npwp = $request->npwp;
        $this->new_pegawai->alamat = $request->alamat;
        $this->new_pegawai->gender = $request->gender;
        $this->new_pegawai->telepon = $request->telepon;
        $this->new_pegawai->tgl_lahir = $request->tgl_lahir;
        $this->new_pegawai->jabatan = $request->jabatan;
        $this->new_pegawai->bidang = $request->bidang;
        $this->new_pegawai->puskesmas_id = $request->puskesmas_id;



        $this->new_pegawai->avatar = $namaFile;

        $nm->move(public_path() . '/img', $namaFile);
        $this->new_pegawai->slug = Str::slug($request->nama, '-');
        $this->new_pegawai->save();
        return redirect()->route('pegawai')->with('status', 'Data Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $pegawai_show = pegawai::find($id);
        $pegawai_show = DB::table('pegawai')
            ->join('tbl_puskesmas', 'tbl_puskesmas.id', '=', 'pegawai.puskesmas_id')
            ->select('tbl_puskesmas.*', 'pegawai.*', 'tbl_puskesmas.nama as nama_puskesmas')
            ->where('pegawai.id', '=', $id)
            ->first();

        // var_dump($pegawai_show);
        // die;

        return view('pegawai.show', [
            'showPegawai' => $pegawai_show
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = pegawai::all();
        $allPuskesmas = puskesmas::all();

        $data = DB::table('pegawai')
            ->join('tbl_puskesmas', 'pegawai.puskesmas_id', '=', 'tbl_puskesmas.id')
            ->select('pegawai.*', 'tbl_puskesmas.*', 'tbl_puskesmas.nama as nama_puskesmas', 'tbl_puskesmas.id as id_puskesmas')
            ->where('pegawai.id', '=', $id)
            ->get();

        $pegawai_edit = pegawai::find($id);
        return view(
            'pegawai.edit',
            [
                'dataPegawai' => $pegawai_edit,
                'datas' => $datas,
                'puskesmas' => $data,
                'allPuskesmas' => $allPuskesmas
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pegawai_edit = pegawai::find($id);
        $pegawai_edit->nama = $request->nama;
        $pegawai_edit->npwp = $request->npwp;
        $pegawai_edit->alamat = $request->alamat;
        $pegawai_edit->gender = $request->gender;
        $pegawai_edit->telepon = $request->telepon;
        $pegawai_edit->tgl_lahir = $request->tgl_lahir;
        $pegawai_edit->jabatan = $request->jabatan;
        $pegawai_edit->bidang = $request->bidang;
        // $pegawai_edit->puskesmas_id = $request->puskesmas_id;


        $gambarLama = $pegawai_edit->avatar;
        $pegawai_edit->slug = Str::slug($request->nama, '-');

        if (!$request->avatar) {
            $pegawai_edit->avatar = $gambarLama;
        } else {

            // update gambar baru
            if ($request->avatar != $gambarLama) {


                $nm = $request->avatar;
                $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
                $pegawai_edit->avatar = $namaFile;

                $nm->move(public_path() . '/img', $namaFile);
            } else {
                $request->avatar->move(public_path() . '/img', $gambarLama);
            }
        }

        $pegawai_edit->save();
        return redirect()->route('pegawai')->with('status', 'Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai_hapus = pegawai::findOrFail($id); //bila dicari dan  error maka akan ditampilkan 404 not found
        $image_path = "img/" . $pegawai_hapus->image;

        if (File::exists($image_path)) {
            File::delete($image_path);
        }



        $pegawai_hapus->delete();
        return redirect()->route('pegawai')->with('status', 'Data Berhasil Dihapus');
    }
}
