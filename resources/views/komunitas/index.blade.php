@extends('Admin.layout.main')
@section('content')
{{-- @if ($message = Session::get('success'))
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
	@endif --}}
<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 10px">ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($komunitas as $komunitas)
            <tr>
                <td>{{ $komunitas->id }}</td>
                <td>{{ $komunitas->nama }}</td>
                <td>
                    <a href="{{ route('komunitas.show', $komunitas->id) }}" class="btn btn-info">Detail</a>
                    <a href="{{ route('komunitas.edit', $komunitas->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('komunitas.destroy', $komunitas->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{-- </div> --}}
@endsection
