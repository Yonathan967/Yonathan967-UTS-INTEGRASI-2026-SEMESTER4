<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pemanenan;
use App\Services\StokService;
use Illuminate\Http\Request;

class PenjualanController extends Controller
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
        $allkategori = Penjualan::all();
        return view('penjualan.index', compact('allkategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penjualan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'Nama_Pembeli' => 'required|string',
        'jenis_tanaman' => 'required|string',
        'jumlah_pembelian' => 'required|integer|min:1',
        'harga' => 'required|numeric|min:0',
        'tanggal_pembelian' => 'required|date',
    ]);

    $cekStok = $this->stokService->cekStokPanen(
        $validated['jenis_tanaman'], 
        $validated['jumlah_pembelian']
    );

    if (!$cekStok['status']) {
        return redirect()
            ->back()
            ->withInput()
            ->withErrors(['jumlah_pembelian' => $cekStok['message']])
            ->with('notifications', [[
                'message' => $cekStok['message'],
                'type' => 'stok-error',
                'duration' => 10000
            ]]);
    }

    Penjualan::create($validated);

    return redirect()
        ->route('penjualan.index')
        ->with('success', 'Data penjualan berhasil ditambahkan')
        ->with('notifications', [[
            'message' => '✅ Data penjualan berhasil ditambahkan',
            'type' => 'success',
            'duration' => 4000
        ]]);
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }

   public function cetak()
{
     $data = Penjualan::all();
    return view('penjualan.cetak', compact('data'));
}

    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        return view('penjualan.edit', compact('penjualan'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'Nama_Pembeli'       => 'required|string',
        'jenis_tanaman'      => 'required|string',
        'tanggal_pembelian'  => 'required|date',
        'jumlah_pembelian'   => 'required|integer|min:1',
        'harga'              => 'required|numeric|min:0',
    ]);

    $penjualan = Penjualan::findOrFail($id);

    $cekStok = $this->stokService->cekStokPanen(
        $validatedData['jenis_tanaman'], 
        $validatedData['jumlah_pembelian']
    );

    if (!$cekStok['status']) {
        return redirect()
            ->back()
            ->withInput()
            ->withErrors(['jumlah_pembelian' => $cekStok['message']])
            ->with('notifications', [[
                'message' => $cekStok['message'],
                'type' => 'stok-error',
                'duration' => 10000
            ]]);
    }

    $penjualan->update($validatedData);

    return redirect()
        ->route('penjualan.index')
        ->with('success', 'Data penjualan berhasil diperbarui')
        ->with('notifications', [[
            'message' => '✅ Data penjualan berhasil diperbarui',
            'type' => 'success',
            'duration' => 4000
        ]]);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();
        return redirect()->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil dihapus');
    }
}
