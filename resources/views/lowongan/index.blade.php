@extends('Admin.layout.main')
@section('content')
@if ($message = Session::get('success'))
	  <div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		  <strong>{{ $message }}</strong>
	  </div>
	@endif

	@if ($message = Session::get('error'))
	  <div class="alert alert-danger alert-block">
	    <button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	  </div>
	@endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col" style="width: 10px">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Komunitas</th>
                <th scope="col">Gaji</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Lokasi</th>
                <th scope="col" style="width: 30px">Gambar</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lowongan as $index => $lowongan )
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $lowongan->nama }}</td>
                <td>{{ $lowongan->komunitas->nama }}</td>
                <td>{{ $lowongan->gaji }}</td>
                {{-- <td>{{ $lowongan->jenis }}</td> --}}
                <td>{{ $lowongan->deskripsi }}</td>
                <td>{{ $lowongan->lokasi }}</td>
                <td><img src="{{ asset('gambar/' . $lowongan->gambar) }}" alt="" style="width: 150px"></td>
                <td>
                <a href="{{ route('lowongan.edit', $lowongan->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('lowongan.destroy', $lowongan->id) }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>

                @endforeach
        </tbody>
    </table>
@endsection
