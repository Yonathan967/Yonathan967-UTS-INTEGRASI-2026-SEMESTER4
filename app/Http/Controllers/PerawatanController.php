<?php

namespace App\Http\Controllers;

use App\Models\Perawatan;
use Illuminate\Http\Request;

class PerawatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allkategori = Perawatan::all();
        return view('Perawatan.index', compact('allkategori'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('perawatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'jenis_perawatan' => 'required|string',
            'tanggal_perawatan' => 'required|date',
            'user_name' => 'required|string',
        ]);

        Perawatan::create($validated);

        return redirect()
            ->route('perawatan.index')
            ->with('success', 'Data perawatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
public function show(Perawatan $perawatan)
{
    return response()->json([
        'success' => true,
        'data' => $perawatan
    ]);
}

      public function cetak()
{
     $data = Perawatan::all();
    return view('perawatan.cetak', compact('data'));
}
    public function edit(Perawatan $perawatan)
    {
        return view('perawatan.edit', compact('perawatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perawatan $perawatan)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'jenis_perawatan' => 'required|string',
            'tanggal_perawatan' => 'required|date',
            'user_name' => 'required|string',
        ]);

        $perawatan->update($validated);

        return redirect()
            ->route('perawatan.index')
            ->with('success', 'Data perawatan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perawatan $perawatan)
    {
        $perawatan->delete();

        return redirect()
            ->route('perawatan.index')
            ->with('success', 'Data perawatan berhasil dihapus');
    }
}
