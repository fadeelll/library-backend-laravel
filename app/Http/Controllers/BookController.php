<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan semua buku
    public function index()
    {
        return response()->json(Book::all());
    }

    // Menambah buku baru (Admin Only)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'stok' => 'required|integer',
        ]);

        $book = Book::create($validated);
        return response()->json(['message' => 'Buku berhasil ditambah', 'data' => $book], 201);
    }

    // Update data buku
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return response()->json(['message' => 'Buku berhasil diupdate', 'data' => $book]);
    }

    // Hapus buku
    public function destroy($id)
    {
        Book::destroy($id);
        return response()->json(['message' => 'Buku berhasil dihapus']);
    }
}