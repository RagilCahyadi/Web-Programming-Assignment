<?php

namespace App\Http\Controllers;

use App\Models\Bengkel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BengkelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortBy = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'asc');
        
        // Validasi kolom yang bisa disort
        $allowedSortColumns = ['id', 'nama_barang', 'merk', 'stok', 'harga'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'id';
        }
        
        // Validasi direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        return view('bengkel.index', compact('sortBy', 'sortDirection'));
    }

    /**
     * Get data for DataTable (AJAX)
     */
    public function getData(Request $request)
    {
        $sortBy = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'asc');
        
        // Validasi kolom yang bisa disort
        $allowedSortColumns = ['id', 'nama_barang', 'merk', 'stok', 'harga'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'id';
        }
        
        // Validasi direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }

        $bengkels = Bengkel::orderBy($sortBy, $sortDirection)->get();
        return response()->json($bengkels);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string'
        ]);

        $bengkel = Bengkel::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil ditambahkan!',
            'data' => $bengkel
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bengkel $bengkel): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $bengkel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bengkel $bengkel): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $bengkel
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bengkel $bengkel): JsonResponse
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string'
        ]);

        $bengkel->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil diupdate!',
            'data' => $bengkel
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bengkel $bengkel): JsonResponse
    {
        $bengkel->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil dihapus!'
        ]);
    }
}
