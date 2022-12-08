<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::INDEX;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        // $rules = [
        //     'name' => "required|min:5|max:20", //unique : nama_tabel, nama_kolom
        //     'email' => "required|min:5|max:25",
        //     'username' => "required|min:5|max:20",
        //     'password' => "required|min:5|max:20",
        //     'password_confirmation' => "required|same:password",
        //     'alamat' => "required|min:20|max:200",
        //     'phone' => "required|digits_between:10,12",
        // ];
        // $messages = [
        //     'required' => ":attribute tidak boleh kosong",
        //     'min' => ":attribute karakter terlalu pendek",
        //     'max' => ":attribute karakter terlalu panjang / terlalu besar",
        //     'mimes' => ":attribute ekstensi error, gunakan .png, .jpg, .jpeg",
        //     'unique' => ":attribute sudah ada, silahkan masukkan :attribute lain"
        // ];
        // return $this->validate($request, $rules, $messages);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'roles' => '["USER"]',
            'password' => Hash::make($data['password']),
        ]);
    }
}
