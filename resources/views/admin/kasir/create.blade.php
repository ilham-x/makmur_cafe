@extends('admin.layout')

@section('title','Tambah Kasir')

@section('content')

<div class="card">

    @if ($errors->any())
        <div style="color:red; font-weight:900; margin-bottom:15px;">
            @foreach ($errors->all() as $error)
                <div>- {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.kasir.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:15px;">
            <label>Nama</label><br>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Email</label><br>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Simpan</button>
    </form>

</div>

@endsection