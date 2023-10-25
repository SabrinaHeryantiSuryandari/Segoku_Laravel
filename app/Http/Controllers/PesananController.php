<?php

namespace App\Http\Controllers;

use App\Models\LabaBulanan;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use PDF;
use Carbon\Carbon;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pesanan = DB::table('pesanans')
            ->join('menus', 'pesanans.menus_id', '=', 'menus.id')
            ->join('users', 'pesanans.users_id', '=', 'users.id')
            ->select('users.*', 'menus.*', 'pesanans.*', )
        ->get();

        return view('admin.pesanan',  
        ['pesanan' => $pesanan],
        // // ['user' => $user],
        // ['menu' => $menu],
        )->with('i', (request()->input('page', 1) - 1) * 5);
        // dd($menu);
    }
    public function index2()
    {
        $pesanan = DB::table('pesanans')
            ->join('menus', 'pesanans.menus_id', '=', 'menus.id')
            ->join('users', 'pesanans.users_id', '=', 'users.id')
            ->select('users.*','menus.*', 'pesanans.*', )
        ->get();
        

        return view('admin.laporan',  
        ['pesanan' => $pesanan],
        );
    }
    public function cetak_pdf()
    {
        $pesanan = DB::table('pesanans')
            ->join('menus', 'pesanans.menus_id', '=', 'menus.id')
            ->join('users', 'pesanans.users_id', '=', 'users.id')
            ->select('users.*','menus.*', 'pesanans.*', )
        ->get();
 
        $pdf = PDF::loadview('admin.laporan_pdf',['pesanan'=>$pesanan])->setPaper('f4', 'potrait');
        
        return $pdf->download('laporan_pesanan.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'users_id' => 'required',
            'menus_id' => 'required',
            'tanggal_pesanan' => 'required',
            'jumlah_pesanan' => 'required',
            'deskripsi_pesanan' => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $menu = Menu::find($request->menus_id);
        $total = $request->jumlah_pesanan * $menu->harga;
        $biaya_produksi = $request->jumlah_pesanan * $menu->biaya_produksi;
        $lababulanan = $total - $biaya_produksi;
        $satus = 'Pembayaran';

        $data['users_id']     = $request->users_id;
        $data['menus_id']     = $request->menus_id;
        $data['tanggal_pesanan'] = $request->tanggal_pesanan;
        $data['jumlah_pesanan'] = $request->jumlah_pesanan;
        $data['deskripsi_pesanan']     = $request->deskripsi_pesanan;
        $data['total']     = $total;
        // $data['status']     = $request->status;
        $data['status']     = 'Pembayaran';
        $data['laba']     = $lababulanan;

        Pesanan::create($data);

        return redirect()->route('pesanan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'users_id' => 'required',
            'menus_id' => 'required',
            'tanggal_pesanan' => 'required',
            'jumlah_pesanan' => 'required',
            'deskripsi_pesanan' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $menu = Menu::find($request->menus_id);
        $total = $request->jumlah_pesanan * $menu->harga;
        $biaya_produksi = $request->jumlah_pesanan * $menu->biaya_produksi;
        $lababulanan = $total - $biaya_produksi;

        $data['users_id']     = $request->users_id;
        $data['menus_id']     = $request->menus_id;
        $data['tanggal_pesanan'] = $request->tanggal_pesanan;
        $data['jumlah_pesanan'] = $request->jumlah_pesanan;
        $data['deskripsi_pesanan']     = $request->deskripsi_pesanan;
        $data['total']     = $total;
        $data['laba']     = $lababulanan;
        $data['status']     = $request->status;

        Pesanan::find($id)->update($data);
        // Pesanan::find($id)->update($request->all());
        
        return back()->with('success', ' Data telah diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
