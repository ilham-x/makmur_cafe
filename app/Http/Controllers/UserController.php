<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $kasirs = User::where('role','cashier')->paginate(10);
        return view('admin.kasir.index', compact('kasirs'));
    }

    public function create()
    {
        return view('admin.kasir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>'cashier'
        ]);

        return redirect()->route('admin.kasir.index')
            ->with('success','Kasir berhasil ditambahkan');
    }

    public function show(User $kasir)
    {
        return view('admin.kasir.show', compact('kasir'));
    }

    public function edit(User $kasir)
    {
        return view('admin.kasir.edit', compact('kasir'));
    }

    public function update(Request $request, User $kasir)
    {
        $kasir->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);

        return redirect()->route('admin.kasir.index')
            ->with('success','Kasir berhasil diupdate');
    }

    public function destroy(User $kasir)
    {
        $kasir->delete();

        return redirect()->route('admin.kasir.index')
            ->with('success','Kasir berhasil dihapus');
    }
}