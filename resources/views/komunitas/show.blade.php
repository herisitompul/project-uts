@extends('Admin.layout.main')
@section('content')
<p><strong>ID:</strong> {{ $komunitas->id }}</p>
    <p><strong>Name:</strong> {{ $komunitas->nama }}</p>
    <h3>Lowongan in this komunitas</h3>
    @if($lowongan->isEmpty())

        <p>No lowongan found for this komunitas.</p>
    @else
        <ul>
            @foreach($lowongan as $lowongan)
                <li>
                    <a href="{{ route('lowongan.show', $lowongan->id) }}"><h3>{{ $lowongan->judul }}</h3></a>
                    <p>{{ $lowongan->deskripsi }}</p>
                    <p>Komunitas: {{ $lowongan->komunitas->nama }}</p>
                    <img src="{{ asset('gambar/' . $lowongan->gambar) }}" alt="{{ $lowongan->judul }}" width="200"> <br> <br>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('komunitas.index') }}" class="btn btn-secondary">Back</a>
@endsection
