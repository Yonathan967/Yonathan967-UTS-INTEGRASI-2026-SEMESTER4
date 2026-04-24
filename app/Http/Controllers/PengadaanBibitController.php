<?php

namespace App\Http\Controllers;

use App\Models\PengadaanBibit;
use Illuminate\Http\Request;

class PengadaanbibitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allkategori = PengadaanBibit::all();
        return view('pengadaan_bibit.index', compact('allkategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengadaan_bibit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'jenis_bibit' => 'required',
        'jumlah_pembelian' => 'required|integer',
        'tanggal_pembelian' => 'required|date',
        'harga' => 'required|numeric',
    ]);

    PengadaanBibit::create($validated);

    return redirect()
        ->route('pengadaan_bibit.index')
        ->with('success', 'Data pengadaan berhasil ditambahkan');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengadaan_bibit = PengadaanBibit::findOrFail($id);
        return view('pengadaan_bibit.show', compact('pengadaan_bibit'));
    }

    public function cetak()
{
     $data = PengadaanBibit::all();
    return view('pengadaan_bibit.cetak', compact('data'));
}

    public function edit($id)
    {
        $pengadaan_bibit = PengadaanBibit::findOrFail($id);

        return view('pengadaan_bibit.edit', compact('pengadaan_bibit'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'jenis_bibit'        => 'required|string',
        'tanggal_pembelian'  => 'required|date',
        'jumlah_pembelian'   => 'required|integer',
        'harga'              => 'required|numeric',
    ]);

    $pengadaan_bibit = PengadaanBibit::findOrFail($id);

    $pengadaan_bibit->update($validatedData);

    return redirect()
        ->route('pengadaan_bibit.index')
        ->with('success', 'Data pengadaan berhasil diperbarui');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengadaan_bibit = PengadaanBibit::findOrFail($id);
        $pengadaan_bibit->delete();
        return redirect()->route('pengadaan_bibit.index')
            ->with('success', 'Data pengadaan berhasil dihapus');
    }
}
