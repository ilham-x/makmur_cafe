<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::latest()->paginate(10);
        return view('admin.meja.index', compact('mejas'));
    }

    public function create()
    {
        return view('admin.meja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|unique:mejas'
        ]);

        Meja::create([
            'nomor_meja' => $request->nomor_meja,
            'kode_qr' => Str::uuid(),
            'status' => 'aktif'
        ]);

        return redirect()->route('admin.meja.index')
            ->with('success','Meja berhasil ditambahkan');
    }

    public function show($id)
{
    $meja = \App\Models\Meja::findOrFail($id);
    return view('admin.meja.show', compact('meja'));
}
    public function edit(Meja $meja)
    {
        return view('admin.meja.edit', compact('meja'));
    }

    public function update(Request $request, Meja $meja)
    {
        $request->validate([
            'nomor_meja' => 'required|unique:mejas,nomor_meja,'.$meja->id
        ]);

        $meja->update([
            'nomor_meja' => $request->nomor_meja,
            'status' => $request->status
        ]);

        return redirect()->route('admin.meja.index')
            ->with('success','Meja berhasil diupdate');
    }

    public function destroy(Meja $meja)
    {
        $meja->delete();

        return redirect()->route('admin.meja.index')
            ->with('success','Meja berhasil dihapus');
    }
}