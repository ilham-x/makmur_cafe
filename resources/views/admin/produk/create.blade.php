@extends('admin.layout')

@section('title','Tambah Produk')

@section('content')

<div class="card">

    @if ($errors->any())
        <div style="color:red; font-weight:900; margin-bottom:15px;">
            @foreach ($errors->all() as $error)
                <div>- {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.produk.store') }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom:15px;">
            <label>Nama Produk</label><br>
            <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Harga</label><br>
            <input type="number" name="harga" value="{{ old('harga') }}" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Stok</label><br>
            <input type="number" name="stok" value="{{ old('stok') }}" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Deskripsi</label><br>
            <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>
        </div>

        <div style="margin-bottom:15px;">
            <label>Gambar Produk</label><br>
            <input type="file" name="gambar" accept="image/*">
        </div>

        <button type="submit">Simpan</button>
    </form>

</div>

@endsection