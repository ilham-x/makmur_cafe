@extends('admin.layout')

@section('title','Dashboard')

@section('content')

<div class="card">
    Total Pendapatan: Rp {{ number_format($totalPendapatan,0,',','.') }}
</div>

<div class="card">
    Total Transaksi: {{ $totalTransaksi }}
</div>

<div class="card">
    Total Produk: {{ $totalProduk }}
</div>

<div class="card">
    <canvas id="incomeChart"></canvas>
</div>

@endsection

@section('script')
<script>
const ctx = document.getElementById('incomeChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($pendapatanPerHari->pluck('tanggal')) !!},
        datasets: [{
            label: 'Pendapatan',
            data: {!! json_encode($pendapatanPerHari->pluck('total')) !!},
            borderWidth: 3
        }]
    }
});
</script>
@endsection