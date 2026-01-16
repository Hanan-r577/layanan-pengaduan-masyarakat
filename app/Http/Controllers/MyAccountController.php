<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyAccountController extends Controller
{
    public function index()
    {
        return view('my_account.index', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.$user->id],
            'telp' => ['required', 'digits_between:10,15'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->telp = $request->telp;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Akun berhasil diperbarui.');
    }
}
