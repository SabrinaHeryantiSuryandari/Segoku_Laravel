<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PembayaranUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user()->id;
        // $pesanan = Pesanan::where('pesanans.users_id', 'like', "%" . $user . "%")
        $pesanan = Pesanan::where( 'pesanans.users_id', '=', $user )
            ->join('menus', 'pesanans.menus_id', '=', 'menus.id')
            ->join('users', 'pesanans.users_id', '=', 'users.id')
            ->select('users.*', 'menus.*', 'pesanans.*', )
        ->get();

        return view('user.pembayaran' , compact('pesanan'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    public function upload(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'bukti' => 'required|mimes:png,jpg,jpeg|max:2048',
            
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('GAGAL', 'Menu Gagal Diperbarui!');

        // dd($request->all());

        $photo = $request->file('bukti');
        $filename = date('y-m-d').$photo->getClientOriginalName();
        $path = 'photo/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($photo));

        $data['bukti']     = $filename;

        Pesanan::find($id)->update($data);
        // User::find($id)->update($request->all());
    
        return back()->with('success', ' Data telah diperbaharui!');
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
        //
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
        $validator = Validator::make($request->all(),[
            'bukti' => 'required|mimes:png,jpg,jpeg|max:2048',
            
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('GAGAL', 'Menu Gagal Diperbarui!');

        // dd($request->all());

        $photo = $request->file('bukti');
        $filename = date('y-m-d').$photo->getClientOriginalName();
        $path = 'photo/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($photo));

        $data['bukti']     = $filename;

        Pesanan::find($id)->update($data);
        // User::find($id)->update($request->all());
    
        return back()->with('success', ' Data telah diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
