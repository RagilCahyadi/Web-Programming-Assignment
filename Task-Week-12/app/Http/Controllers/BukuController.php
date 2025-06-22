<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

/**
 * Controller untuk mengelola data buku
 * Menyediakan operasi CRUD (Create, Read, Update, Delete) untuk entitas Buku
 */
class BukuController extends Controller
{
    /**
     * Menampilkan daftar semua buku dengan fitur sorting
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $sortBy = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'asc');
        
        // Validasi kolom yang bisa di-sort
        $allowedSortColumns = ['id', 'judul', 'penulis', 'tahun_terbit', 'penerbit', 'kategori'];
        
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'id';
        }
        
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc';
        }
        
        $bukus = Buku::orderBy($sortBy, $sortDirection)->get();
        
        return view('buku.index', compact('bukus', 'sortBy', 'sortDirection'));
    }

    /**
     * Menampilkan form untuk membuat buku baru
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Menyimpan buku baru ke database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'penerbit' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string'
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail buku tertentu
     *
     * @param Buku $buku
     * @return \Illuminate\View\View
     */
    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    /**
     * Menampilkan form untuk mengedit buku
     *
     * @param Buku $buku
     * @return \Illuminate\View\View
     */
    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    /**
     * Memperbarui data buku di database
     *
     * @param Request $request
     * @param Buku $buku
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'penerbit' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string'
        ]);

        $buku->update($request->all());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Menghapus buku dari database
     *
     * @param Buku $buku
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }
}
