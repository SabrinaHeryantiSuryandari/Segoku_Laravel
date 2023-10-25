<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        // $user = User::where('users.id', 'like', "%" . $id . "%")
        $user = User::where( 'users.id', '=', $id)
            ->select( 'users.*')
        ->get();
        // dd($user);
        return view('user.akun' , compact('user'));
    }
    
        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {
            $validator = Validator::make($request->all(),[
                'profil' => 'required|mimes:png,jpg,jpeg|max:2048',
                'name' => 'required',
                'alamat' => 'required',
                'tlp'          => 'required',
            ]);
    
            if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator)->with('GAGAL', 'Menu Gagal Diperbarui!');
    
            // dd($request->all());
    
            $photo = $request->file('profil');
            $filename = date('y-m-d').$photo->getClientOriginalName();
            $path = 'photo/'.$filename;
    
            Storage::disk('public')->put($path,file_get_contents($photo));
    
            $data['profil']     = $filename;
            $data['name'] = $request->name;
            $data['tlp'] = $request->tlp;
            $data['alamat']     = $request->alamat;

            User::find($id)->update($data);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
