<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller


{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = barang::all();
        return view('barang', compact('barang'));
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


    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'required|image'
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = Str::slug($request->nama) . '-' . time() . '.' . $image->getClientOriginalExtension();
            // Simpan ke storage/app/public/kue dengan filename
            $image->storeAs('kue/' . $filename);
        }

        Barang::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $filename,
        ]);

        return redirect()->route('barang.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = barang::find($id);
        return view('barang-edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        $barang = barang::where('id',$id)->first();
        $filename = $barang->gambar;
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = Str::slug($request->nama) . '-' . time() . '.' . $image->getClientOriginalExtension();
            // Simpan ke storage/app/public/kue dengan filename
            $image->storeAs('kue/' . $filename);
        }

        Barang::find($id)->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $filename,
        ]);
        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Barang::find($id)->delete();
        return redirect()->back();
    }
}
