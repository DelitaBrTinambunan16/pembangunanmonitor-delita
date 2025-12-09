<?php
namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    // Tambahkan parameter Request $request pada function index()
    public function index(Request $request)
    {
        // Daftar kolom yang bisa difilter sesuai pada form pencarian
        $filterableColumns = ['sumber_dana'];

        // berisikan array pada nama kolom yang akan dicari saat searching
        $searchableColumns = [
            'nama_proyek',
            'lokasi',
            'tahun',
            'kode_proyek',
            'anggaran',
            'sumber_dana',
            'deskripsi',
        ];
        // //Gunakan scope filter pada model proyek untuk memproses query filter
        $proyeks = Proyek::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)  // untuk memanggil fitur search pada model nantinya.
            ->simplePaginate(10); // Pagination 10 data per halaman

        return view('pages.admin.proyek.index', compact('proyeks'));
    }

    public function create()
    {
        return view('pages.admin.proyek.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_proyek' => 'required|unique:proyek',
            'nama_proyek' => 'required',
            'tahun'       => 'required|digits:4',
            'lokasi'      => 'required',
            'anggaran'    => 'required|numeric',
            'sumber_dana' => 'required',
            'deskripsi'   => 'nullable',
        ]);

        Proyek::create($request->all());
        return redirect()->route('proyek.index')->with('success', 'Data proyek berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $proyek = Proyek::findOrFail($id);
        return view('pages.admin.proyek.edit', compact('proyek'));
    }

    public function show($id)
    {
        $proyek = Proyek::findOrFail($id);
        return view('pages.admin.proyek.show', compact('proyek'));
    }

    public function update(Request $request, $id)
    {
        $proyek = Proyek::findOrFail($id);

        $request->validate([
            'kode_proyek' => 'required|unique:proyek,kode_proyek,' . $id . ',proyek_id',
            'nama_proyek' => 'required',
            'tahun'       => 'required|digits:4',
            'lokasi'      => 'required',
            'anggaran'    => 'required|numeric',
            'sumber_dana' => 'required',
            'deskripsi'   => 'nullable',
        ]);

        $proyek->update($request->all());
        return redirect()->route('proyek.index')->with('success', 'Data proyek berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $proyek = Proyek::findOrFail($id);
        $proyek->delete();
        return redirect()->route('proyek.index')->with('success', 'Data proyek berhasil dihapus!');
    }
}
