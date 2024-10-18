@extends('Admin.layout.main')
@section('content')
<form action="{{ route('lowongan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>Tambah Lowongan</h3>
            <div class="form-group">
                <label for="title">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            {{-- komunitas --}}
            <div class="form-group">
                <label for="komunitas_id">Komunitas:</label>
                <select class="form-control" id="komunitas_id" name="komunitas_id" required>
                    @foreach($komunitas as $komunitasItem)
                        <option value="{{ $komunitasItem->id }}">{{ $komunitasItem->nama }}</option>
                    @endforeach
                </select>
            </div>
            {{-- gaji --}}
            <div class="form-group">
                <label for="price">Gaji</label>
                <input type="number" class="form-control" id="gaji" name="gaji" required>
            </div>
            {{-- <div class="form-group">
                <label for="komunitas_id">komunitas:</label>
                <select class="form-control" id="komunitas_id" name="komunitas_id" required>
                    @foreach($komunitas as $komunitas)
                        <option value="{{ $komunitas->id }}">{{ $komunitas->nama }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <label for="details">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
            </div>
            <div class="form-group">
                <label for="details">Lokasi</label>
                <textarea class="form-control" id="details" name="lokasi" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    @endsection
