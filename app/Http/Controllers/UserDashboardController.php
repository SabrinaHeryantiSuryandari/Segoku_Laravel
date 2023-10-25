<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserDashboardController extends Controller
{
    public function index()
    {
        // $user = Auth::user()->id;
        $user = User::all();
        $menu = Menu::all();

        return view('user.dashboard' , compact('menu', 'user'));
    }
    public function index2()
    {
        return view('user.contact');
    }
    public function about()
    {
        return view('user.about');
    }
    // public function store(Request $request,menu $id)
    // {
    //     $validator = Validator::make($request->all(),[
    //         // 'users_id' => 'required',
    //         'menus_id' => 'required',
    //         'tanggal_pesanan' => 'required',
    //         'jumlah_pesanan' => 'required',
    //         'deskripsi_pesanan' => 'required',
    //     ]);

    //     if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
    //     // if($validator->fails()) return redirect()->withErrors($validator);

    //     // $user = User::find($id);
    //     $user = Auth::user()->id;
    //     // $menu = menu::menu()->id;
    //     $menu = Menu::find($request->menus_id);
    //     // $menu = Menu::find($id);
    //     // $menu = $m->id;
    //     // dd($menu);

    //     // $hargamenu = $request->menus_id = $menu->id;
    //     $total = $request->jumlah_pesanan * $menu->harga;
    //     $biaya_produksi = $request->jumlah_pesanan * $menu->biaya_produksi;
    //     $lababulanan = $total - $biaya_produksi;
    //     $satus = 'Pembayaran';
        
    //     $data['users_id']     = $user;
    //     $data['menus_id']     = $menu->id;
    //     $data['tanggal_pesanan'] = $request->tanggal_pesanan;
    //     $data['jumlah_pesanan'] = $request->jumlah_pesanan;
    //     $data['deskripsi_pesanan']     = $request->deskripsi_pesanan;
    //     $data['total']     = $total;
    //     // $data['status']     = $request->status;
    //     $data['status']     = 'Pembayaran';
    //     $data['laba']     = $lababulanan;
        
    //     // dd($data);
    //     Pesanan::create($data);

    //     return redirect()->route('usermenu.index');
    // }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('usermenu.index')->with('success', 'Menu Berhasil Dihapus!');
    }
}
