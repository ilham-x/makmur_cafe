@extends('admin.layout')

@section('title','Data Kasir')

@section('content')

<a href="{{ route('admin.kasir.create') }}">
    <button>+ Tambah Kasir</button>
</a>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kasirs as $kasir)
            <tr>
                <td>{{ $kasir->name }}</td>
                <td>{{ $kasir->email }}</td>
                <td>{{ ucfirst($kasir->role) }}</td>
                <td>{{ $kasir->created_at->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('admin.kasir.edit',$kasir->id) }}">
                        <button>Edit</button>
                    </a>

                    <form action="{{ route('admin.kasir.destroy',$kasir->id) }}" 
                          method="POST" 
                          style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus kasir?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Belum ada kasir</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div>
    {{ $kasirs->links() }}
</div>

@endsection