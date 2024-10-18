@extends('Admin.layout.main')
@section('content')

<form action="{{ route('komunitas.store') }}" method="POST">
    @csrf
    <h3>Tambah Komunitas</h3>
    <div class="form-group">
        <label for="title">Nama Komunitas</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
