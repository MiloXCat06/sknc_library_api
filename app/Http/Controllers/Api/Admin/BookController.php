<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Http\Response;

class BookController extends Controller
{
    // Menampilkan semua buku
    public function index()
    {
        $books = Book::all();
        return response()->json(['data' => $books], Response::HTTP_OK);
    }

    // Menampilkan informasi buku berdasarkan ID
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Buku tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['data' => $book], Response::HTTP_OK);
    }

    // Menyimpan buku yang baru ditambahkan
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'synopsis' => 'required',
            'isbn' => 'required|unique:books',
            'writer' => 'required',
            'page_amount' => 'required',
            'stock_amount' => 'required',
            'published' => 'required',
            'category' => 'required',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'status' => 'required',
        ]);

        $book = Book::create($request->all());

        return response()->json(['message' => 'Buku berhasil ditambahkan', 'data' => $book], Response::HTTP_CREATED);
    }

    // Mengupdate informasi buku berdasarkan ID
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Buku tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'title' => 'required|unique:books,title,' . $id,
            'synopsis' => 'required',
            'isbn' => 'required|unique:books,isbn,' . $id,
            'writer' => 'required',
            'page_amount' => 'required',
            'stock_amount' => 'required',
            'published' => 'required',
            'category' => 'required',
            'photo' => 'image|mimes:jpeg,jpg,png|max:2000',
            'status' => 'required',
        ]);

        $book->update($request->all());

        return response()->json(['message' => 'Informasi buku berhasil diupdate', 'data' => $book], Response::HTTP_OK);
    }

    // Menghapus buku berdasarkan ID
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Buku tidak ditemukan'], Response::HTTP_NOT_FOUND);
        }

        $book->delete();

        return response()->json(['message' => 'Buku berhasil dihapus'], Response::HTTP_OK);
    }
}
