<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;

use Illuminate\Http\Request;

class KomunitasController extends Controller
{
    public function index()
    {
        $komunitas = Komunitas::all();
        return view('komunitas.index', ['komunitas' => $komunitas]);
    }

    public function create()
    {
        return view('komunitas.create');
    }

    public function store(Request $request)
    {
        Komunitas::create($request->all());
        return redirect('/komunitas')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $komunitas = Komunitas::find($id);
        return view('komunitas.edit', ['komunitas' => $komunitas]);
    }

    public function update(Request $request, $id)
    {
        $komunitas = Komunitas::find($id);
        $komunitas->update($request->all());
        return redirect('/komunitas')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $komunitas = Komunitas::find($id);
        $komunitas->delete();
        return redirect('/komunitas')->with('success', 'Data berhasil dihapus');
    }
}
