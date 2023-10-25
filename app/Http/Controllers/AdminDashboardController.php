<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminDashboardController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $dataselesai = Pesanan::where('pesanans.status', 'like', "%" . 'selesai' . "%")
        ->get();
        $selesai = count($dataselesai);
        
        $dataterbayar = Pesanan::where('pesanans.status', 'like', "%" . 'terbayar' . "%")
        ->get();
        $terbayar = count($dataterbayar);

        // $pesananmingguan = Pesanan::where(STR_TO_DATE('col', date('l, d-m-Y')))->date_sub(CURDATE(), INTERVAL(DAY_7));
        
        $date = Carbon::today()->subDay();
        $pesananmingguan = Pesanan::where('tanggal_pesanan', '>=',$date)
        // ->where('tanggal_pesanan', '<=',$date, '+', '7')
        ->join('menus', 'pesanans.menus_id', '=', 'menus.id')
        ->join('users', 'pesanans.users_id', '=', 'users.id')
        ->select('users.*','menus.*', 'pesanans.*', )
        ->get();
        // dd($pesananmingguan);


        $pesanan        = collect(DB::SELECT("SELECT count(tanggal_pesanan) as jumlah from pesanans"))->first();
        $label         = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        for($bulan=1;$bulan < 13;$bulan++){
        $chartuser     = collect(DB::SELECT("SELECT count(tanggal_pesanan) AS jumlah from pesanans where month(tanggal_pesanan)='$bulan'"))->first();
        $jumlah_pesanan[] = $chartuser->jumlah;
        }

        // $categories = [];
        // $pesanan = Pesanan::all();
        // $pesanan = [];

        // foreach($pesanan as $p){
        //     $pesasnan = 
        // }
        // dd(json_encode($jumlah_pesanan));

        return view('admin.dashboard', compact('selesai', 'terbayar', 'pesananmingguan', 
        'pesanan', 
        'label', 
        'jumlah_pesanan'
        ));
        // ))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'status' => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['status']     = $request->status;

        Pesanan::find($id)->update($data);
        
        return back()->with('success', ' Data telah diperbaharui!');
    }
    // public function date()
    // {

    // }
}
