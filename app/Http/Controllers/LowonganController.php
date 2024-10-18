<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komunitas;
use App\Models\Lowongan;

class LowonganController extends Controller
{
    // Tampilkan semua lowongan
    public function index()
    {
        $lowongan = Lowongan::all();
        $lowongan = Lowongan::with('komunitas')->get();
        return view('lowongan.index', compact('lowongan'));
    }

    // Halaman untuk menambah lowongan
    public function create()
    {
        $komunitas = Komunitas::all();
        return view('lowongan.create', compact('komunitas'));
    }

    // Simpan lowongan baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'komunitas_id'=>'required',
            'gaji'=>'required|numeric',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Proses upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('gambar'), $nama_file);

            // Simpan lowongan dengan gambar yang sudah diupload
            Lowongan::create([
                'nama' => $request->nama,
                'komunitas_id' => $request->komunitas_id,
                'gaji' => $request->gaji,
                'deskripsi' => $request->deskripsi,
                'lokasi' => $request->lokasi,
                'gambar' => $nama_file
            ]);

            return redirect()->route('lowongan.index')->with('success', 'lowongan berhasil ditambahkan');
        }

        return redirect()->route('lowongan.create')->with('error', 'Gambar gagal diupload');
    }

    // Hapus lowongan
    public function destroy(Lowongan $lowongan)
    {
        $lowongan = Lowongan::findOrFail($id);
        // Hapus file gambar dari folder
        if (file_exists(public_path('gambar/' . $lowongan->gambar))) {
            unlink(public_path('gambar/' . $lowongan->gambar));
        }

        // Hapus data dari database
        $lowongan->delete();
        return back()->with('success', 'lowongan berhasil dihapus.');
    }

    // Tampilkan halaman edit lowongan
    public function edit(Lowongan $lowongan)
    {
        $komunitas = Komunitas::all();
        // $lowongan = lowongan::findOrFail($id);
        return view('lowongan.edit', compact('lowongan', 'komunitas'));;
    }

    // // Update lowongan yang ada
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'judul' => 'required',
    //         'deskripsi' => 'required',
    //         'harga' => 'required|numeric',
    //         'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    //     ]);

    //     $lowongan = lowongan::findOrFail($id);

    //     // Jika ada gambar baru, hapus gambar lama dan upload yang baru
    //     if ($request->hasFile('gambar')) {
    //         if (file_exists(public_path('gambar/' . $lowongan->gambar))) {
    //             unlink(public_path('gambar/' . $lowongan->gambar));
    //         }

    //         $file = $request->file('gambar');
    //         $nama_file = time() . "_" . $file->getClientOriginalName();
    //         $file->move(public_path('gambar'), $nama_file);

    //         $lowongan->gambar = $nama_file;
    //     }

    //     // Update data lowongan
    //     $lowongan->update([
    //         'judul' => $request->judul,
    //         'deskripsi' => $request->deskripsi,
    //         'harga' => $request->harga,
    //         'gambar' => $nama_file
    //     ]);

    //     return redirect()->route('lowongan.index')->with('success', 'lowongan berhasil diperbarui');
    // }
    // Update lowongan yang ada
public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required',
        'komunitas_id'=>'required',
        'gaji'=>'required|numeric',
        'deskripsi' => 'required',
        'lokasi' => 'required',
        'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $lowongan = Lowongan::findOrFail($id);

    // Inisialisasi nama file gambar lama
    $nama_file = $lowongan->gambar;

    // Jika ada gambar baru, hapus gambar lama dan upload yang baru
    if ($request->hasFile('gambar')) {
        if (file_exists(public_path('gambar/' . $lowongan->gambar))) {
            unlink(public_path('gambar/' . $lowongan->gambar));
        }

        $file = $request->file('gambar');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('gambar'), $nama_file);
    }

    // Update data lowongan, gambar hanya diupdate jika ada gambar baru
    $lowongan->update([
        'nama' => $request->nama,
        'komunitas_id' => $request->komunitas_id,
        'gaji' => $request->gaji,
        'deskripsi' => $request->deskripsi,
        'lokasi' => $request->lokasi,
        'gambar' => $nama_file
    ]);

    return redirect()->route('lowongan.index')->with('success', 'lowongan berhasil diperbarui');
}


public function dashboard()
{
    $lowongans = Lowongan::all(); // Ambil semua lowongan dari database
    return view('user.dashboard', compact('lowongans'));
}

}
