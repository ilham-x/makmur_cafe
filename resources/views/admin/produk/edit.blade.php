@extends('admin.layout')

@section('title','Edit Produk')

@section('content')

<div class="card">

    @if ($errors->any())
        <div style="color:red; font-weight:900; margin-bottom:15px;">
            @foreach ($errors->all() as $error)
                <div>- {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.produk.update', $produk->id) }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom:15px;">
            <label>Nama Produk</label><br>
            <input type="text" name="nama_produk" 
                   value="{{ old('nama_produk', $produk->nama_produk) }}" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Harga</label><br>
            <input type="number" name="harga" 
                   value="{{ old('harga', $produk->harga) }}" required>
        </div>

    

        <div style="margin-bottom:15px;">
            <label>Kategori</label><br>
            <select name="kategori" required>
                <option value="">Pilih Kategori</option>
               
                    <option value="{{ $produk->kategori}}" >
                        {{ $produk->kategori }}
                    </option>
                    <option value="Kopi">Kopi</option>
                    <option value="Non-Kopi">Non-Kopi</option>
                    <option value="Soda">Soda</option>
                    <option value="Makanan Ringan">Makanan Ringan</option>
                    <option value="Tansu">Tansu</option>
                    <option value="Roti Panggang">Roti Panggang</option>
                    <option value="Makanan Berat">Makanan Berat</option>
                    <option value="Mie Rebus/Goreng">Mie Rebus/Goreng</option>
                
            </select>
        </div>

        <div style="margin-bottom:15px;">
            <label>Gambar Produk</label><br>
            <input type="file" name="gambar" accept="image/*"><br><br>

            @if($produk->gambar)
                <img src="{{ asset('storage/'.$produk->gambar) }}" 
                     width="120" 
                     style="border-radius:10px;">
            @endif
        </div>

        <button type="submit">Update</button>
    </form>

</div>

@endsection