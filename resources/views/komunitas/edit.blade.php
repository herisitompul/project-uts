@extends('Admin.layout.main')
@section('content')
<form action="{{ route('komunitas.update', $komunitas->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Nama:</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $komunitas->nama }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
