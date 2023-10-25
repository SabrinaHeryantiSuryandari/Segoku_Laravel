<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Database\Eloquent\Collection;

class PesananUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        // $pesanan = Pesanan::where('pesanans.users_id', 'like', "%" . $user . "%")
        $pesanan = Pesanan::where( 'pesanans.users_id', '=', $user)
            ->join('menus', 'pesanans.menus_id', '=', 'menus.id')
            ->join('users', 'pesanans.users_id', '=', 'users.id')
            ->select('users.*', 'menus.*', 'pesanans.*', )
        ->get();

        return view('user.pesananuser' , compact('pesanan'))
        // ->with('i', (request()->input('page', 1) - 1) * 5)
        ;
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
    public function store(Request $request,menu $id)
    {
        $validator = Validator::make($request->all(),[
            // 'users_id' => 'required',
            'menus_id' => 'required',
            'tanggal_pesanan' => 'required',
            'jumlah_pesanan' => 'required',
            'deskripsi_pesanan' => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        // if($validator->fails()) return redirect()->withErrors($validator);

        // $user = User::find($id);
        $user = Auth::user()->id;
        // $menu = menu::menu()->id;
        $menu = Menu::find($request->menus_id);
        // $menu = Menu::find($id);
        // $menu = $m->id;
        // dd($menu);

        // $hargamenu = $request->menus_id = $menu->id;
        $total = $request->jumlah_pesanan * $menu->harga;
        $biaya_produksi = $request->jumlah_pesanan * $menu->biaya_produksi;
        $lababulanan = $total - $biaya_produksi;
        $satus = 'Pembayaran';
        
        $data['users_id']     = $user;
        $data['menus_id']     = $menu->id;
        $data['tanggal_pesanan'] = $request->tanggal_pesanan;
        $data['jumlah_pesanan'] = $request->jumlah_pesanan;
        $data['deskripsi_pesanan']     = $request->deskripsi_pesanan;
        $data['total']     = $total;
        // $data['status']     = $request->status;
        $data['status']     = 'Pembayaran';
        $data['laba']     = $lababulanan;
        
        // dd($data);
        Pesanan::create($data);

        // return redirect()->route('usermenu.pembayaran');
        return redirect()->route('pembayaranuser.index');
        // return view('user.pembayaran');
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
    public function update(Request $request,Menu $id)
    {
        $validator = Validator::make($request->all(),[
            // 'users_id' => 'required',
            'menus_id' => 'required',
            'tanggal_pesanan' => 'required',
            'jumlah_pesanan' => 'required',
            'deskripsi_pesanan' => 'required'
        ]);

        // dd($validator);
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $menu = Menu::find($request->menus_id);
        // dd($menu);
        $total = $request->jumlah_pesanan * $menu->harga;
        $biaya_produksi = $request->jumlah_pesanan * $menu->biaya_produksi;
        $lababulanan = $total - $biaya_produksi;

        $data['menus_id']     = $request->menus_id;
        $data['tanggal_pesanan'] = $request->tanggal_pesanan;
        $data['jumlah_pesanan'] = $request->jumlah_pesanan;
        $data['deskripsi_pesanan']     = $request->deskripsi_pesanan;
        $data['total']     = $total;
        $data['laba']     = $lababulanan;
        // $data['status']     = $request->status;
        // dd($data);
        Pesanan::find($id)->update($data);
        // Pesanan::find($id)->update($request->all());
        
        return back()->with('success', ' Data telah diperbaharui!');
        // return redirect()->route('pesananuser.index')->with('success', ' Data telah diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesananuser)
    {
        $pesananuser->delete();

        return redirect()->route('pesananuser.index')->with('success', 'Pesanan Berhasil Dihapus!');
    }
}
