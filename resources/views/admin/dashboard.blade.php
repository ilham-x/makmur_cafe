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
    <canvas id="incomeChart" height="100"></canvas>
</div>

@endsection

@section('script')
<script>
const ctx = document.getElementById('incomeChart').getContext('2d');

// ambil data dari blade
const dataPendapatan = {!! json_encode($pendapatanPerHari->pluck('total')) !!};

new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($pendapatanPerHari->pluck('tanggal')) !!},
        datasets: [{
            label: 'Pendapatan 7 Hari Terakhir',
            data: dataPendapatan,
            borderWidth: 3,
            tension: 0.3,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true
            }
        },
        scales: {
            y: {
                beginAtZero: true,

                // 🔥 AUTO SCALE (RECOMMENDED)
                suggestedMin: 0,
                suggestedMax: Math.max(10000, ...dataPendapatan) + 20000,

                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});
</script>
@endsection