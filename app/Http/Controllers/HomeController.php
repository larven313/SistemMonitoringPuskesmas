<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\obat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-guest')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $id_user = Auth::user()->id;


        $tgl_kunjungan = $request->tgl_kunjungan;
        // $jam = Carbon::createFromTimeString('02:00:00');
        // $jam = Carbon::createFromTime(14, 0, 0);
        $jam_buka = Carbon::parse('05:30');
        $jam_tutup = Carbon::parse('16:30');
        $tgl_skrng = Carbon::now()->isoFormat('Y-MM-DD');
        $jam_skrng = Carbon::now()->isoFormat('H-m');

        // $test = $jam_buka <= $jam_tutup ? 'true' : 'false';

        // dd($test);
        $data = DB::table('categories')
            ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
            ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
            ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
            ->join('users', 'users.id', 'categories.user_id')
            ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas', 'tbl_poli.id as poli_id')
            ->where('categories.status_antrian', '!=', "Selesai")
            ->where('tgl_kunjungan', '>=', $tgl_skrng)
            ->where('jam_kunjungan', '>=', $jam_buka)
            ->where('jam_kunjungan', '<=', $jam_tutup)
            // ->where('jam_kunjungan', '<=', $jam_skrng)
            ->where('categories.user_id', 'LIKE', $id_user)
            ->get();

        if (Auth::user()->roles == '["STAFF"]') {
            $jmlh_antri = DB::table('categories')
                ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('categories.status_antrian', '!=', "Selesai")
                ->where('admin_id', 'LIKE', $id_user)
                ->count();


            $jumlah = DB::table('categories')
                ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('admin_id', 'LIKE', $id_user)
                ->where('tgl_kunjungan', '=', $tgl_skrng)
                ->count();



            // $batas_pasien = DB::table('categories')
            //     ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
            //     ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
            //     ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
            //     ->select('categories.*', 'tbl_puskesmas.batas_pasien', 'tbl_puskesmas.nama as nama_puskesmas')
            //     ->where('admin_id', 'LIKE', $id_user)->first();

            // $jmlh_pasien = $batas_pasien->batas_pasien - $jumlah;

            $user = DB::table('tbl_puskesmas')
                ->join('users', 'tbl_puskesmas.admin_id', '=', 'users.id')
                ->select('users.*', 'tbl_puskesmas.*', 'tbl_puskesmas.id as id_puskesmas')
                ->get();

            // dd($user);


            $batas_pasien = DB::table('categories')
                ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->select('categories.*', 'tbl_puskesmas.batas_pasien', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('admin_id', 'LIKE', $id_user)->first();

            // dd($batas_pasien);

            $jmlh_pasien = $batas_pasien->batas_pasien - $jumlah;


            $jmlh_selesai = DB::table('categories')
                ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('admin_id', 'LIKE', $id_user)
                ->count();

            $jmlh_obat = DB::table('tbl_obat')
                ->join('tbl_puskesmas', 'tbl_obat.puskesmas_id', 'tbl_puskesmas.id')
                ->join('tbl_puskesmas_item', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->select('tbl_obat.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('admin_id', 'LIKE', $id_user)
                ->count();
        } else if (Auth::user()->roles == '["USER"]') {
            $jmlh_antri = DB::table('categories')
                ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->join('users', 'users.id', '=', 'categories.user_id')
                ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('categories.status_antrian', '!=', "Selesai")
                ->where('categories.user_id', 'LIKE', $id_user)
                ->count();

            $jumlah = DB::table('categories')
                ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('categories.user_id', 'LIKE', $id_user)
                ->count();

            $jmlh_selesai = DB::table('categories')
                ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('categories.user_id', 'LIKE', $id_user)
                ->count();

            $jmlh_obat = DB::table('tbl_obat')
                ->join('tbl_puskesmas', 'tbl_obat.puskesmas_id', 'tbl_puskesmas.id')
                ->join('tbl_puskesmas_item', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->join('categories', 'categories.puskesmas_id', '=', 'tbl_puskesmas_item.id')
                ->select('tbl_obat.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('categories.user_id', 'LIKE', $id_user)
                ->count();
            $jmlh_pasien = DB::table('categories')
                ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('categories.user_id', 'LIKE', $id_user)
                ->where('categories.status_antrian', 'LIKE', 'Konfirmasi')
                ->count();
        } else {
            // ini dashboard admin
            $jmlh_antri = DB::table('categories')
                ->join('users', 'categories.user_id', 'users.id')
                ->select('categories.*', 'users.*')
                ->where('categories.status_antrian', '==', "Selesai")
                ->where('categories.user_id', '=', $id_user)
                ->count();


            $jumlah = DB::table('categories')
                ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('admin_id', 'LIKE', $id_user)
                ->where('tgl_kunjungan', '=', $tgl_skrng)
                ->count();



            $batas_pasien = DB::table('categories')
                ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->select('categories.*', 'tbl_puskesmas.batas_pasien', 'tbl_puskesmas.nama as nama_puskesmas')
                ->where('admin_id', 'LIKE', $id_user)->first();


            // dd($batas_pasien);

            // $jmlh_pasien = $batas_pasien->batas_pasien - $jumlah;
            $jmlh_pasien = Category::count();


            // $jmlh_pasien = 0;

            $jmlh_selesai = DB::table('categories')
                ->join('tbl_puskesmas_item', 'categories.puskesmas_id', 'tbl_puskesmas_item.id')
                ->join('tbl_poli', 'tbl_puskesmas_item.poli_id', 'tbl_poli.id')
                ->join('tbl_puskesmas', 'tbl_puskesmas_item.puskesmas_id', 'tbl_puskesmas.id')
                ->select('categories.*', 'tbl_poli.nama_poli', 'tbl_puskesmas.nama as nama_puskesmas')
                ->count();

            $jmlh_obat = obat::count();
        }






        return view('home', [
            'jumlahPasien' => $jmlh_pasien,
            'jmlhAntri' => $jmlh_antri,
            'jmlhSelesai' => $jmlh_selesai,
            'jmlhObat' => $jmlh_obat,
            'data' => $data,
            'jam_skrng' => $jam_skrng,
            'tgl_skrng' => $tgl_skrng
        ]);
    }
}
