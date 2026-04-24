<?php

namespace App\Http\Controllers;

use App\Models\ManajemenAkun;
use Illuminate\Http\Request;
use App\Models\User;    
use Illuminate\Support\Facades\Hash;

class ManajemenAkunController extends Controller
{
    public function index()
    {
        $users = ManajemenAkun::all();
        return view('manajemen_akun.index', compact('users'));
    }

    public function create()
    {
        return view('manajemen_akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|size:8',
            'role' => 'required',
        ]);

        ManajemenAkun::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()
            ->route('manajemen_akun.index')
            ->with('success', 'Akun berhasil ditambahkan');
    }

    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('manajemen_akun.edit', compact('user'));
}

   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'role' => 'required',
        'password' => 'nullable|size:8'
    ]);

    $data = $request->only(['name', 'email', 'role']);

    //untuk update password jika diisi ini opsional
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('manajemen_akun.index')
        ->with('success', 'Akun berhasil diperbarui');
}
    public function destroy($id)
    {
        $manajemenAkun = ManajemenAkun::findOrFail($id);
        $manajemenAkun->delete();

        return redirect()
            ->route('manajemen_akun.index')
            ->with('success', 'Data akun berhasil dihapus');
    }
}
    