<?php

namespace App\Http\Controllers;

use App\Models\puskesmas;
use App\Models\puskesmas_item;
use App\Models\poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class PuskesmasItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public $new_puskesmas;

    public function __construct()
    {
        $this->new_puskesmas = new puskesmas();
        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-categories')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_show = puskesmas::all();
        $poli_show = poli::all();

        $join_puskesmas = DB::table('tbl_puskesmas')
            ->join('users', 'users.id', '=', 'tbl_puskesmas.admin_id')
            ->first();

        $users = User::all()->where('roles', '=', '["STAFF"]');

        return view('puskesmas.tambah', [
            'dataPuskesmas' => $category_show,
            'dataPoli' => $poli_show,
            'joinPuskesmas' => $join_puskesmas,
            'users' => $users
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
            'kode_puskesmas' => "required|min:1|max:14|unique:tbl_puskesmas,kode_puskesmas",
            'admin_id' => "unique:tbl_puskesmas,admin_id",
            'nama' => "required|min:1|max:130|unique:tbl_puskesmas,nama",
            // 
        ];
        $messages = [
            'required' => "tidak boleh kosong",
            'min' => ":attribute karakter terlalu pendek",
            'max' => ":attribute karakter terlalu panjang / terlalu besar",
            'mimes' => ":attribute ekstensi error, gunakan .png, .jpg, .jpeg",
            'unique' => ":attribute sudah ada, silahkan masukkan :attribute lain",

        ];
        $this->validate($request, $rules, $messages);



        // dd($request);



        $this->new_puskesmas->kode_puskesmas = $request->kode_puskesmas;
        $this->new_puskesmas->nama = $request->nama;
        $this->new_puskesmas->alamat = $request->alamat;


        $this->new_puskesmas->save();
        return redirect()->route('puskesmas')->with('status', 'Created Successfully ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $puskesmas_hapus = puskesmas_item::findOrFail($id);

        // dd($puskesmas_hapus);
        $puskesmas_hapus->delete();

        return redirect()->route('puskesmas')->with('status', 'Data berhasil dihapus');
    }
}
