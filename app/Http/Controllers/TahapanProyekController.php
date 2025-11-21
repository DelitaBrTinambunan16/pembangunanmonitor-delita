<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahapanProyek;
use App\Models\Proyek;

class TahapanProyekController extends Controller
{
    public function index(Request $request)
    {
        //Daftar kolom yang bisa difilter sesuai pada form pencarian
        $filterableColumns = ['nama_tahap'];

        //Search
        $searchableColumns = [
            'proyek_id',
            'nama_tahap',
            'target_persen',
            'tgl_mulai',
            'tgl_selesai'
        ];
        //Gunakan scope filter pada model TahapanProyek untuk memproses query filter
        $tahapan = TahapanProyek::filter($request, $filterableColumns)
        ->search($request, $searchableColumns)
        ->simplePaginate(10);
        return view('pages.admin.tahapan.index', compact('tahapan'));
    }

    // Menampilkan form tambah tahapan
    public function create()
    {
        $proyek = Proyek::all();

        // Tambahkan daftar pilihan nama tahap
        $pilihanTahap = [
            'Perencanaan',
            'Persiapan',
            'Pelaksanaan',
            'Pengawasan',
            'Penyelesaian'
        ];

        return view('pages.admin.tahapan.create', compact('proyek', 'pilihanTahap'));
    }

    // Menyimpan data tahapan baru
    public function store(Request $request)
    {
        $request->validate([
            'proyek_id' => 'required',
            'nama_tahap' => 'required',
            'target_persen' => 'required|numeric',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
        ]);

        TahapanProyek::create($request->all());

        return redirect()->route('tahapan.index')
            ->with('success', 'Tahapan proyek berhasil ditambahkan.');
    }

    // Menampilkan form edit tahapan
    public function edit($id)
    {
        $tahapan = TahapanProyek::findOrFail($id);
        $proyek = Proyek::all();

        // Tambahkan daftar pilihan nama tahap
        $pilihanTahap = [
            'Perencanaan',
            'Persiapan',
            'Pelaksanaan',
            'Pengawasan',
            'Penyelesaian'
        ];

        return view('pages.admin.tahapan.edit', compact('tahapan', 'proyek', 'pilihanTahap'));
    }

    // Menyimpan perubahan tahapan
    public function update(Request $request, $id)
    {
        $request->validate([
            'proyek_id' => 'required',
            'nama_tahap' => 'required',
            'target_persen' => 'required|numeric',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
        ]);

        $tahapan = TahapanProyek::findOrFail($id);
        $tahapan->update($request->all());

        return redirect()->route('tahapan.index')
            ->with('success', 'Tahapan proyek berhasil diperbarui.');
    }

    // Menghapus tahapan
    public function destroy($id)
    {
        $tahapan = TahapanProyek::findOrFail($id);
        $tahapan->delete();

        return redirect()->route('tahapan.index')
            ->with('success', 'Tahapan proyek berhasil dihapus.');
    }

    // Menampilkan detail tahapan
    public function show($id)
    {
        $tahapan = TahapanProyek::with('proyek')->findOrFail($id);
        return view('pages.admin.tahapan.show', compact('tahapan'));
    }
}
