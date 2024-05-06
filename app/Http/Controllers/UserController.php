<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('user.index',[
            "title"=>"Data Pengguna",
            "data"=>user::all()
        ]);
    }
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            "name"=>"required",
            "email"=>"email:dns",
            "password"=>"required"
        ]);
        $password=Hash::make($request->password);
        $request->merge([
            "password"=>$password
        ]);
        user::create($request->all());
        return Redirect()->route('pengguna.index')->with('success','Data User Berhasil Ditambahkan');
    }
}
