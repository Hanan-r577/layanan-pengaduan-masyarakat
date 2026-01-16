<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telp' => 'required|digits_between:10,15',
            'password' => 'required|string|min:8',
            'level' => 'required|in:admin,masyarakat',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telp' => $request->telp,
            'password' => bcrypt($request->password),
            'level' => $request->level,
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
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
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id.',id_user',
            'password' => 'nullable|min:5',
            'telp' => 'required|digits_between:10,15',
            'level' => 'required',
        ]);

        $user = User::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'telp' => $request->telp,
            'level' => $request->level,
        ];

        // password hanya diupdate jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('user.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if (! $user) {
            return redirect()->route('user.index')->with([
                'status' => 'danger',
                'title' => 'Gagal',
                'message' => 'User tidak ditemukan!',
            ]);
        }

        $user->delete();

        return redirect()->route('user.index')->with([
            'status' => 'success',
            'title' => 'Berhasil',
            'message' => 'Data Berhasil Dihapus!',
        ]);
    }
}
