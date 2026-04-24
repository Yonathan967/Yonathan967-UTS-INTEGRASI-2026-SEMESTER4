<?php

namespace App\Http\Controllers;

use App\Models\MasaTanam;
use Illuminate\Http\Request;

class MasaTanamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allkategori = MasaTanam::all();
        return view('masatanam.index', compact('allkategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masatanam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_petani'    => 'required|string',
            'jenis_tanaman'  => 'required|string',
            'lokasi_tanaman' => 'required|string',
            'tanggal_tanam'  => 'required|date',
        ]);

        MasaTanam::create($validated);

        return redirect()
            ->route('masatanam.index')
            ->with('success', 'Data masa tanam berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $masatanam = MasaTanam::findOrFail($id);
        return view('masatanam.show', compact('masatanam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $masatanam = MasaTanam::findOrFail($id);
        return view('masatanam.edit', compact('masatanam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_petani'    => 'required|string',
            'jenis_tanaman'  => 'required|string',
            'lokasi_tanaman' => 'required|string',
            'tanggal_tanam'  => 'required|date',
        ]);

        $masatanam = MasaTanam::findOrFail($id);
        $masatanam->update($validatedData);

        return redirect()
            ->route('masatanam.index')
            ->with('success', 'Data masa tanam berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $masatanam = MasaTanam::findOrFail($id);
        $masatanam->delete();
        return redirect()->route('masatanam.index')
            ->with('success', 'Data masa tanam berhasil dihapus');
    }
}
