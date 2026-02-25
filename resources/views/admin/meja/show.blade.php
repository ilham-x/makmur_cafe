@extends('admin.layout')

@section('title','Detail Meja')

@section('content')

<a href="{{ route('admin.meja.index') }}">
    <button style="margin-bottom:20px;">← Kembali</button>
</a>

<div class="card" style="max-width:500px;">

    <h2 style="margin-bottom:15px;">
        Meja {{ $meja->nomor_meja }}
    </h2>

    <p>
        <strong>Status:</strong>
        @if($meja->status == 'aktif')
            <span style="color:green; font-weight:bold;">
                Aktif
            </span>
        @else
            <span style="color:red; font-weight:bold;">
                Nonaktif
            </span>
        @endif
    </p>

    <hr style="margin:20px 0;">

    <h3>QR Code</h3>

    <div style="margin:15px 0; text-align:center;">
        {!! QrCode::size(200)->generate(url('/menu/'.$meja->kode_qr)) !!}
    </div>

    <p style="text-align:center;">
        <small>
            Scan untuk membuka menu meja {{ $meja->nomor_meja }}
        </small>
    </p>

    <div style="text-align:center; margin-top:15px;">
        <a href="{{ url('/menu/'.$meja->kode_qr) }}" target="_blank">
            <button>Buka Link Menu</button>
        </a>
    </div>

</div>

@endsection