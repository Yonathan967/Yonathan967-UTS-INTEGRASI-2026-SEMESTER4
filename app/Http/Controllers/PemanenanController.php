<?php

namespace App\Http\Controllers;

use App\Models\Pemanenan;
use Illuminate\Http\Request;

class PemanenanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allkategori = Pemanenan::all();
        return view('pemanenan.index', compact('allkategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemanenan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'jenis_tanaman' => 'required|string',
            'jumlah_panen' => 'required|integer',
            'tanggal_panen' => 'required|date',
            'user_name' => 'required|string',
        ]);

        Pemanenan::create($validated);

        return redirect()
            ->route('pemanenan.index')
            ->with('success', 'Data pemanenan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemanenan $pemanenan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function cetak()
{
     $data = Pemanenan::all();
    return view('pemanenan.cetak', compact('data'));
}
public function edit(Pemanenan $pemanenan)
    {
        return view('pemanenan.edit', compact('pemanenan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemanenan $pemanenan)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'jenis_tanaman' => 'required|string',
            'jumlah_panen' => 'required|integer',
            'tanggal_panen' => 'required|date',
            'user_name' => 'required|string',
        ]);

        $pemanenan->update($validated);

        return redirect()
            ->route('pemanenan.index')
            ->with('success', 'Data pemanenan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemanenan $pemanenan)
    {
        $pemanenan->delete();

        return redirect()
            ->route('pemanenan.index')
            ->with('success', 'Data pemanenan berhasil dihapus');
    }
}
