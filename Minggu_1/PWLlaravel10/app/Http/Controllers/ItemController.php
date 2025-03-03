<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller // menunjukkan subclass
{
    public function index()//menampilkan daftar item
    {
        $items = Item::all(); // Mengambil semua data item dari database
        return view('items.index', compact('items')); // Mengirim data ke view 'items.index'
    }

    public function create()//menampilkan form untuk menambah item baru
    {
        return view('items.create'); // Mengembalikan tampilan form create item
    }

    public function store(Request $request) //mennyimpan data baru ke database
    {
        $request->validate([ // validasi input, untuk memastikan nama dan deskripsi diisi 
            'name' => 'required',
            'description' => 'required',
        ]);
         
         Item::create($request->only(['name', 'description'])); // menyimpan data yang tervalidasi 
        return redirect()->route('items.index')->with('success', 'Item added successfully.'); //Redirect ke halaman daftar item dengan pesan sukses
    }

    public function show(Item $item)// menampilkan item dari item tertentu
    {
        return view('items.show', compact('item'));// Mengirim data item ke view 'items.show'
    }

    public function edit(Item $item) //menampilkan form untuk mengedit item tertentu 
    {
        return view('items.edit', compact('item')); // mengambilkan tampilan form edit item 
    }

    public function update(Request $request, Item $item) // memperbarui item yang sudah ada di database
    {
        $request->validate([  // Validasi input, memastikan name dan description harus diisi
            'name' => 'required',
            'description' => 'required',
        ]);
         
        //$item->update($request->all());
        //return redirect()->route('items.index');
        // Hanya masukkan atribut yang diizinkan
         $item->update($request->only(['name', 'description']));// Mengupdate data item yang ada dengan data yang sudah tervalidasi
        return redirect()->route('items.index')->with('success', 'Item updated successfully.');// Redirect ke halaman daftar item dengan pesan sukses
    }

    public function destroy(Item $item) //Menghapus item dari database
    {
        
       // return redirect()->route('items.index');
       $item->delete(); //Menghapus item dari database
       return redirect()->route('items.index')->with('success', 'Item deleted successfully.'); // Redirect ke halaman daftar item dengan pesan sukses
    }
}