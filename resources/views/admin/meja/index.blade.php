@extends('admin.layout')

@section('title','Meja')

@section('content')

<a href="{{route('admin.meja.create')}}">Tambah</a>


<div class="card">
<table>
<thead>
<tr>
<th>No Meja</th>
<th>Status</th>
<th>QR</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
@foreach($mejas as $meja)
<tr>
<td>{{ $meja->nomor_meja }}</td>
<td>{{ $meja->status }}</td>
<td>
    <a href="{{ route('admin.meja.show',$meja->id) }}">Lihat QR</a>
</td>
<td>
    <form action="{{ route('admin.meja.destroy',$meja->id) }}" method="POST">
        @csrf @method('DELETE')
        <button>Hapus</button>
    </form>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>

@endsection