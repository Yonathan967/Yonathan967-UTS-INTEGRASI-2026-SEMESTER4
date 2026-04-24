<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penggajians = Penggajian::with('user')->latest()->paginate(10);
        return view('poinakses.admin.penggajian.index', compact('penggajians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = User::where('role', 'user')->get();
        return view('poinakses.admin.penggajian.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'gaji' => 'required|numeric|min:0',
            'tanggal_gaji' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Penggajian::create($request->all());

        return redirect()->route('penggajian.index')->with('success', 'Penggajian berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penggajian $penggajian)
    {
        $karyawans = User::where('role', 'user')->get();
        return view('poinakses.admin.penggajian.edit', compact('penggajian', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penggajian $penggajian)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'gaji' => 'required|numeric|min:0',
            'tanggal_gaji' => 'required|date',
            'status' => 'required|in:pending,paid',
            'keterangan' => 'nullable|string',
        ]);

        $penggajian->update($request->all());

        return redirect()->route('penggajian.index')->with('success', 'Penggajian berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penggajian $penggajian)
    {
        $penggajian->delete();
        return redirect()->route('penggajian.index')->with('success', 'Penggajian berhasil dihapus');
    }

    public function cetak()
    {
        $penggajians = Penggajian::with('user')->get();
        return view('poinakses.admin.penggajian.cetak', compact('penggajians'));
    }
}
