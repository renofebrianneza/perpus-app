<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Daftar buku + pencarian
    public function index(Request $request)
    {
        $books = Book::when($request->search, function ($query, $search) {
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('pengarang', 'like', "%{$search}%")
                  ->orWhere('kode_buku', 'like', "%{$search}%"); // LATIHAN 2
        })->latest()->paginate(10)->withQueryString();

        return inertia('Books/Index', [
            'books' => $books,
            'search' => $request->search,
        ]);
    }

    // Form tambah buku (Pertemuan 6)
    public function create()
    {
        return inertia('Books/Create');
    }

    // Simpan buku baru (Pertemuan 6)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|unique:books,kode_buku',
            'judul' => 'required|max:255',
            'pengarang' => 'required|max:255',
            'penerbit' => 'nullable|max:255',
            'tahun' => 'nullable|digits:4',
            'stok' => 'required|integer|min:0',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    // Tidak dipakai pada studi kasus ini
    public function show(Book $book)
    {
        //
    }

    // Tampilkan form edit dengan data lama
    public function edit(Book $book)
    {
        return inertia('Books/Edit', [
            'book' => $book,
        ]);
    }

    // Simpan perubahan
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|unique:books,kode_buku,' . $book->id,
            'judul' => 'required|max:255',
            'pengarang' => 'required|max:255',
            'penerbit' => 'nullable|max:255',
            'tahun' => 'nullable|digits:4',
            'stok' => 'required|integer|min:0',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui');
    }

    // Hapus buku
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
    }
}