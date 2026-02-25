@extends('admin.layout')

@section('title','Data Transaksi')

@section('content')

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Meja</th>
                <th>Total Bayar</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $transaksi)
            <tr>
                <td>#{{ $transaksi->id }}</td>
                <td>
                    {{ $transaksi->pesanan->meja->nomor_meja ?? '-' }}
                </td>
                <td>
                    Rp {{ number_format($transaksi->jumlah_bayar,0,',','.') }}
                </td>
                <td>{{ $transaksi->metode_pembayaran ?? '-' }}</td>
                <td>{{ ucfirst($transaksi->status ?? 'selesai') }}</td>
                <td>{{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.transaksi.show',$transaksi->id) }}">
                        <button>Detail</button>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">Belum ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div>
    {{ $transaksis->links() }}
</div>

@endsection