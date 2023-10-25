<?php

namespace App\Http\Controllers;

use App\Models\LabaBulanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LabaBulananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $lababulanan = LabaBulanan::all();
        // $tanggal_pesanan = $request->bulan;
        // $monthlyData = Pesanan::where('pesanans.tanggal_pesanan', 'like', "%" . $tanggal_pesanan . "%")
        //     ->selectRaw('SUBSTRING(tanggal_pesanan, 1, 7) as bulan, SUM(laba) as laba')
        //     ->groupBy('bulan')
        //     ->orderBy('bulan', 'asc')
        // ->get();

        // foreach ($monthlyData as $mon) {
        //     $bulan = $mon->bulan;
        //     $laba = $mon->laba;
        // }
        
        return view('admin.lababulanan.lababulanan', compact('lababulanan'));
        // return view('admin.lababulanan.lababulanan', compact('lababulanan', 'bulan', 'laba'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    // public function create(Request $request)
    {
        
        // return view('admin.HasilLabaBulanan',  
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
        $bln = $request->bulan;
        $monthlyData = Pesanan::where('pesanans.tanggal_pesanan', 'like', "%" . $bln . "%")
        ->selectRaw('SUBSTRING(tanggal_pesanan, 1, 7) as bulan, SUM(laba) as laba')
        ->groupBy('bulan')
        ->orderBy('bulan', 'asc')
        ->get();

        foreach ($monthlyData as $mon) {
        // $bulan = $mon->bulan;
        // $laba = $mon->laba;
            $datalaba['bulan']          = $mon->bulan;
            $datalaba['laba_bulanan']   = $mon->laba;
            LabaBulanan::create($datalaba);
        }

        // dd($monthlyData);
        
        return view('admin.lababulanan.HasilLabaBulanan',  
        // ['bulan' => $bulan],
        // ['laba' => $laba],
        ['monthlyData' => $monthlyData],
        );
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
    public function destroy(lababulanan $lababulanan)
    {
        $lababulanan->delete();

        return redirect()->route('lababulanan.index')->with('success', 'Laba Bulanan Berhasil Dihapus!');
    }
}
