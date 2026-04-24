<?php

namespace App\Http\Controllers;

use App\Models\Penanaman;
use App\Services\StokService;
use Illuminate\Http\Request;

class PenanamanController extends Controller
{
    protected $stokService;

    public function __construct(StokService $stokService)
    {
        $this->stokService = $stokService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allkategori = Penanaman::all();
        return view('penanaman.index', compact('allkategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penanaman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'username' => 'required',
        'lokasi_tanaman' => 'required',
        'jenis_bibit' => 'required',
        'jumlah_bibit' => 'required|integer|min:1',
        'jumlah_tanaman' => 'required|integer|min:1',
        'tanggal_tanam' => 'required|date',
        'user_name' => 'required|string',
    ], [
        'jumlah_bibit.min' => 'Jumlah bibit harus lebih dari 0',
        'jumlah_tanaman.min' => 'Jumlah tanaman harus lebih dari 0',
    ]);

    $cekStok = $this->stokService->cekStokBibit(
        $validated['jenis_bibit'], 
        $validated['jumlah_bibit']
    );

    if (!$cekStok['status']) {
        return redirect()
            ->back()
            ->withInput()
            ->withErrors(['jumlah_bibit' => $cekStok['message']])
            ->with('notifications', [[
                'message' => $cekStok['message'],
                'type' => 'stok-warning',
                'duration' => 10000
            ]]);
    }

    Penanaman::create($validated);

    return redirect()->route('penanaman.index')
        ->with('success', 'Data berhasil disimpan')
        ->with('notifications', [[
            'message' => '✅ Data penanaman berhasil ditambahkan',
            'type' => 'success',
            'duration' => 4000
        ]]);
}


    /**
     * Display the specified resource.
     */
    public function show(Penanaman $penanaman)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * 
     */
    public function cetak()
{
     $data = Penanaman::all();
    return view('penanaman.cetak', compact('data'));
}


   public function edit($id)
    {
        $penanaman = Penanaman::findOrFail($id);

        return view('penanaman.edit', compact('penanaman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penanaman $penanaman)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'lokasi_tanaman' => 'required|string',
            'jenis_bibit' => 'required|string',
            'jumlah_bibit' => 'required|integer|min:1',
            'jumlah_tanaman' => 'required|integer|min:1',
            'tanggal_tanam' => 'required|date',
            'user_name' => 'required|string',
        ], [
            'jumlah_bibit.min' => 'Jumlah bibit harus lebih dari 0',
            'jumlah_tanaman.min' => 'Jumlah tanaman harus lebih dari 0',
        ]);

        $penanaman->update($validated);

        return redirect()
            ->route('penanaman.index')
            ->with('success', 'Data penanaman berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy($id)
    {
        $penanaman = Penanaman::findOrFail($id);
        $penanaman->delete();
        return redirect()->route('penanaman.index')
            ->with('success', 'Data penanaman berhasil dihapus');
    }
}
