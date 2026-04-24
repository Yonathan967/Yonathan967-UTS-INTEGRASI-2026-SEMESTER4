<?php

namespace App\Http\Controllers;

use App\Models\Perawatan;
use Illuminate\Http\Request;

class PerawatanApiController extends Controller
{
    public function index()
    {
        $allkategori = Perawatan::all();

        return response()->json([
            'success' => true,
            'data' => $allkategori,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'jenis_perawatan' => 'required|string',
            'tanggal_perawatan' => 'required|date',
            'user_name' => 'required|string',
        ]);

        $perawatan = Perawatan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data perawatan berhasil ditambahkan',
            'data' => $perawatan,
        ], 201);
    }

    public function show(Perawatan $perawatan)
    {
        return response()->json([
            'success' => true,
            'data' => $perawatan,
        ]);
    }

    public function update(Request $request, Perawatan $perawatan)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'jenis_perawatan' => 'required|string',
            'tanggal_perawatan' => 'required|date',
            'user_name' => 'required|string',
        ]);

        $perawatan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data perawatan berhasil diperbarui',
            'data' => $perawatan,
        ]);
    }

    public function destroy(Perawatan $perawatan)
    {
        $perawatan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data perawatan berhasil dihapus',
        ]);
    }
}
