@extends('admin.layout')

@section('title','Produk')

@section('content')

<a href="{{ route('admin.produk.create') }}">
    <button style="margin-bottom:20px;">+ Tambah Produk</button>
</a>

<div class="card">
    <div style="
        display:grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap:20px;
    ">

        @foreach($produks as $produk)
        <div style="
            border:3px solid #000;
            padding:15px;
            box-shadow:4px 4px 0px #000;
            background:white;
        ">
            
            {{-- Gambar --}}
            @if($produk->gambar)
                <img src="{{ asset('storage/'.$produk->gambar) }}" 
                     style="width:100%; height:150px; object-fit:cover; margin-bottom:10px;">
            @else
                <div style="
                    height:150px;
                    background:#eee;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    margin-bottom:10px;
                ">
                    Tidak ada gambar
                </div>
            @endif

            {{-- Nama --}}
            <h3 style="margin:5px 0;">
                {{ $produk->nama_produk }}
            </h3>

            {{-- Harga --}}
            <p style="font-weight:bold;">
                Rp {{ number_format($produk->harga) }}
            </p>

            {{-- Stok --}}
            <p>
                Stok: 
                <strong>
                    {{ $produk->stok }}
                </strong>
            </p>

            {{-- Aksi --}}
            <div style="margin-top:10px;">
                <a href="{{ route('admin.produk.edit',$produk->id) }}">
                    <button style="padding:5px 10px;">Edit</button>
                </a>

                <form action="{{ route('admin.produk.destroy',$produk->id) }}" 
                      method="POST" 
                      style="display:inline">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Yakin hapus produk ini?')"
                            style="padding:5px 10px;">
                        Hapus
                    </button>
                </form>
            </div>

        </div>
        @endforeach

    </div>
</div>

@endsection