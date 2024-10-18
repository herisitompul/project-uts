@extends('Admin.layout.main')
@section('content')
<form action="{{ route('lowongan.update', $lowongan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $lowongan->nama }}" required>
    </div>
    <div class="form-group">
        <label for="komunitas_id">Komunitas:</label>
        <select class="form-control" id="komunitas_id" name="komunitas_id" required>
            @foreach($komunitas as $komunitasItem)
                <option value="{{ $komunitasItem->id }}">{{ $komunitasItem->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="price">Gaji</label>
        <input type="number" class="form-control" id="gaji" name="gaji" value="{{ $lowongan->gaji }}" required>
    </div>
    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <input type="number" class="form-control" id="deskripsi" name="deskripsi" value="{{ $lowongan->deskripsi }}" required>
    </div>
    <div class="form-group">
        <label for="details">Lokasi</label>
        <textarea class="form-control" id="lokasi" name="lokasi" rows="3" required>{{ $lowongan->lokasi }}</textarea>
    </div>
    <div class="form-group">
        <label for="gambar">Gambar:</label>
        <input type="file" class="form-control" id="gambar" name="gambar">
        <img src="{{ asset('gambar/' . $lowongan->gambar) }}" alt="{{ $lowongan->gambar }}" width="100">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
