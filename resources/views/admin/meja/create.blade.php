@extends('admin.layout')

@section('title','Tambah Meja')

@section('content')

<div class="card">

    @if ($errors->any())
        <div style="color:red; font-weight:900; margin-bottom:15px;">
            @foreach ($errors->all() as $error)
                <div>- {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.meja.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:15px;">
            <label>Nomor Meja</label><br>
            <input type="text" name="nomor_meja" value="{{ old('nomor_meja') }}" required>
        </div>

        <button type="submit">Simpan</button>
    </form>

</div>

@endsection