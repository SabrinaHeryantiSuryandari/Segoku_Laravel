<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Controllers\view;
use App\Models\Prediksi;
// use Dotenv\Validator;
// use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = Menu::all();

        return view('admin.menu', compact('menu'))->with('i', (request()->input('page', 1) - 1) * 5);
        // $menu = Menu::latest()->paginate(5);

        //render view with posts
        // return view('admin.menu', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    // public function create(): View
    {
        return view('admin.menu');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    // public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'nama_menu' => 'required',
            'deskripsi_menu' => 'required',
            'harga'          => 'required',
            'biaya_produksi'          => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        // dd($request->all());

        $photo = $request->file('photo');
        $filename = date('y-m-d').$photo->getClientOriginalName();
        $path = 'photo/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($photo));

        $data['image']     = $filename;
        $data['nama_menu'] = $request->nama_menu;
        $data['deskripsi_menu'] = $request->deskripsi_menu;
        $data['harga']     = $request->harga;
        $data['biaya_produksi']     = $request->biaya_produksi;

        Menu::create($data);

        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('menu.index', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('admin.menu', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'photo' => 'required|mimes:png,jpg,jpeg|max:2048',
            'nama_menu' => 'required',
            'deskripsi_menu' => 'required',
            'harga'          => 'required',
            'biaya_produksi'          => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('GAGAL', 'Menu Gagal Diperbarui!');

        // dd($request->all());

        $photo = $request->file('photo');
        $filename = date('y-m-d').$photo->getClientOriginalName();
        $path = 'photo/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($photo));

        $data['image']     = $filename;
        $data['nama_menu'] = $request->nama_menu;
        $data['deskripsi_menu'] = $request->deskripsi_menu;
        $data['harga']     = $request->harga;
        $data['biaya_produksi']     = $request->biaya_produksi;

        Menu::find($id)->update($data);
        // Menu::find($id)->update($request->all());
        
        return back()->with('success', ' Data telah diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu Berhasil Dihapus!');
    }
}

