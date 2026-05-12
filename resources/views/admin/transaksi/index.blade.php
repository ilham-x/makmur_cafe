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
                    {{ $transaksi->pesanan->nomor_meja ?? '-' }}
                </td>
                <td>
                    Rp {{ number_format($transaksi->total_bayar,0,',','.') }}
                </td>
                <td>{{ $transaksi->pesanan->metode_pembayaran ?? '-' }}</td>
                <td>{{ ucfirst($transaksi->pesanan->status ?? 'selesai') }}</td>
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
    @if ($transaksis->hasPages())
<div class="pagination-wrap">

    {{-- Prev --}}
    @if ($transaksis->onFirstPage())
        <span class="pg-btn disabled">←</span>
    @else
        <a href="{{ $transaksis->previousPageUrl() }}" class="pg-btn">←</a>
    @endif

    {{-- Numbers --}}
    <div class="pg-numbers">
        @foreach ($transaksis->links()->elements[0] ?? [] as $page => $url)
            @if ($page == $transaksis->currentPage())
                <span class="pg-btn active">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="pg-btn">{{ $page }}</a>
            @endif
        @endforeach
    </div>

    {{-- Next --}}
    @if ($transaksis->hasMorePages())
        <a href="{{ $transaksis->nextPageUrl() }}" class="pg-btn">→</a>
    @else
        <span class="pg-btn disabled">→</span>
    @endif

</div>
@endif
</div>

@endsection