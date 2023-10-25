<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->seve();

            return redirect()->back()->with('success', 'Password updated successfully.');
        } else {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
    }
    public function editPassword()
    {
        return view('auth.passwords.edit');
    }

    public function user()
    {
        // $data=User::all();
        // return view('admin/pengguna',$data);
        $data=DB::table('users')->get();
        return view('admin.user',compact('data'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
        // return view('admin.pengguna');
        // dd($data);
    }
    // public function store(Request $request): RedirectResponse
    public function store(Request $data)
    {

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'alamat' => $data['alamat'],
            'tlp' => $data['tlp'],
            'role' => $data['role'],
        ]);
        // $role = Role::where('name', 'user')->first();
        // $user->role()->associate($role);
        // $user->save();
        // User::create([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'password' => Hash::make($request['password']),
        // ]);
        // User::create($request->all());
        return redirect('/datauser')
        // return redirect()->route('/datauser')
                        ->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function hapus($id){
        DB::table('users')->where('id', $id)->delete();

        return redirect('/datauser')->with(['success' => 'Data Berhasil Dihapus!']);
        // return redirect()->route('admin.index')
        //                 ;
    
    }
}
