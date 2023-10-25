<?php

namespace App\Http\Controllers;

use App\Models\PenjualanBulanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenjualanBulananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $penjualanbulanan = PenjualanBulanan::all();
        $penjualanbulanan = PenjualanBulanan::join('menus', 'penjualan_bulanans.menus_id', '=', 'menus.id')
            ->select('menus.*',  'penjualan_bulanans.*' )
        ->get();
        // $tanggal_pesanan = $request->bulan;
        // $menu_id = $request->menus_id;
        // $monthlyData = Pesanan::where('pesanans.tanggal_pesanan', 'like', "%" . $tanggal_pesanan . "%")
        //     ->where('pesanans.menus_id', 'like', "%" . $menu_id . "%")
        //     ->selectRaw('SUBSTRING(jumlah_pesanan, 1, 7) as bulan, SUM(laba) as laba')
        //     ->groupBy('bulan')
        //     ->orderBy('bulan', 'asc')
        //     // ->join('menus', 'pesanans.menus_id', '=', 'menus.id')
        //     // ->select('menus.*', 'pesanans.*', )
        // ->get();

        // foreach ($monthlyData as $mon) {
        //     $menu_id = $mon->menus_id;
        //     $bulan = $mon->bulan;
        //     $laba = $mon->laba;
        // }
        
        return view('admin.penjualan.penjualan', compact('penjualanbulanan'  ));
        // return view('admin.penjualan.penjualan', compact('penjualnbulanan', 'menu_id', 'bulan', 'laba'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    // public function create(Request $request)
    {
        
        // return view('admin.HasilPenjualanBulanan',  
        // // ['bulan' => $bulan],
        // // ['laba' => $laba],
        // ['monthlyData' => $monthlyData],
        // );
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    public function store(Request $request)
    {
        // $tanggal_pesanan = $request->bulan;
        // $monthlyData = Pesanan::where('pesanans.tanggal_pesanan', 'like', "%" . $tanggal_pesanan . "%")
        //     ->groupBy('bulan')
        //     ->orderBy('bulan', 'asc')
        //     // ->join('menus', 'pesanans.menus_id', '=', 'menus.id')
        //     // ->select('menus.*', 'pesanans.*', )
        // ->get();
        $bln = $request->bulan;
        $menu_id = $request->menus_id;
        $monthlyData = Pesanan::where('pesanans.tanggal_pesanan', 'like', "%" . $bln . "%")
            ->where('pesanans.menus_id', 'like', "%" . $menu_id . "%")
            ->selectRaw('SUBSTRING(tanggal_pesanan, 1, 7) as bulan, SUM(jumlah_pesanan) as penjualan')
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
        ->get();

        foreach ($monthlyData as $mon) {
            $datapenjualan['menus_id']          = $menu_id;
            $datapenjualan['bulan']          = $mon->bulan;
            $datapenjualan['penjualan']   = $mon->penjualan;
            PenjualanBulanan::create($datapenjualan);
        }

        $penjualanbulanan = PenjualanBulanan::where('penjualan_bulanans.menus_id', 'like', "%" . $menu_id . "%")
        ->where('penjualan_bulanans.bulan', 'like', "%" . $bln . "%")
        ->join('menus', 'penjualan_bulanans.menus_id', '=', 'menus.id')
        ->select('menus.*',  'penjualan_bulanans.*' )
        ->get();

        // dd($monthlyData);
        
        return view('admin.penjualan.HasilPenjualan',  
        ['penjualanbulanan' => $penjualanbulanan],
        // ['laba' => $laba],
        ['monthlyData' => $monthlyData],
        )->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(penjualanbulanan $penjualanbulanan)
    {
        $penjualanbulanan->delete();

        return redirect()->route('penjualanbulanan.index')->with('success', 'Penjualan Bulanan Berhasil Dihapus!');
    }
}
