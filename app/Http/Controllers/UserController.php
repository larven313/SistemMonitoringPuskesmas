<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\puskesmas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $new_user;
    public function __construct()
    {
        $this->new_user = new User();

        //gunakan middleware untuk cek Gate Authorize User nya
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-users')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }
    public function index(Request $request)
    {
        $jumlah = User::count();
        $batas = 5;
        $data = User::simplePaginate($batas);
        // $no = $batas * ($data->currentPage() - 1);
        $nomor = $batas * ($data->currentPage() - 1);
        $name = $request->name;

        $data = User::where('name', 'LIKE', "%$name%")->simplePaginate($batas);

        return view('users.index', [
            'data' => $data,
            'totalData' => $jumlah,
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


        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $rules = [
            'name' => "required|min:5|max:70|unique:users,username", //unique : nama_tabel, nama_kolom
            'email' => "required|min:5|max:70",
            'username' => "required|min:4|max:50",
            'password' => "required|min:5|max:20",
            'avatar' => "max:55000|mimes:png,jpeg,jpg"


            // 'password_confirmation' => "required|same:password",
            // 'alamat' => "required|min:20|max:200",
            // 'phone' => "required|digits_between:10,12",
            // 'avatar' => "required|max:500|mimes:png,jpeg,jpg"
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

        if (!$nm == null) {
            $namaFile =  time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
        } else {
            $namaFile = '';
        }



        $this->new_user->name = $request->name;
        $this->new_user->email = $request->email;
        $this->new_user->password = Hash::make($request->get('password'));
        $this->new_user->username = $request->username;
        // $this->new_user->roles = json_encode($request->roles);
        $this->new_user->roles = $request->roles;
        $this->new_user->address = $request->address;
        $this->new_user->phone = $request->phone;
        $this->new_user->status = $request->status;
        $this->new_user->gender = $request->gender;

        $this->new_user->avatar = $namaFile;

        if (!$nm == null) {
            $nm->move(public_path() . '/img', $namaFile);
        }
        $this->new_user->save();
        return redirect()->route('users')->with('status', 'Created Successfully ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_show = User::find($id);

        return view(
            'users.show',
            [
                'showUser' => $user_show,

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
        $user_edit = User::find($id);

        // debuging opsi 1
        // var_dump($user_edit);

        // debuging opsi 1
        // print_r($user_edit);

        // passing ke view
        return view(
            'users.edit',
            [
                'dataUser' => $user_edit
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
        $user_edit = User::find($id);
        $user_edit->name = $request->nama;
        $user_edit->email = $request->mail;
        $user_edit->password = $request->passwords;
        $user_edit->username = $request->pengguna;
        $user_edit->address = $request->address;
        $user_edit->phone = $request->telpon;
        $user_edit->status = $request->status;
        $user_edit->roles = $request->roles;
        $user_edit->gender = $request->gender;



        $gambarLama = $user_edit->avatar;

        if (!$request->avatar) {
            $user_edit->avatar = $gambarLama;
        } else {

            // update gambar baru
            if ($request->avatar != $gambarLama) {


                $nm = $request->avatar;
                $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
                $user_edit->avatar = $namaFile;

                $nm->move(public_path() . '/img', $namaFile);
            } else {
                $request->avatar->move(public_path() . '/img', $gambarLama);
            }
        }

        $user_edit->save();
        return redirect()->route('users')->with('status', 'Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_hapus = User::findOrFail($id);

        $puskesmas_id = puskesmas::where('admin_id', '=', $id)->first();

        $image_path = "img/" . $user_hapus->avatar;

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        // dd($puskesmas_id);
        if ($puskesmas_id != null) {
            $puskesmas_id->admin_id = null;
            $puskesmas_id->save();
        }



        $user_hapus->delete();
        return redirect()->route('users')->with('status', 'Data berhasil dihapus');
    }
}
