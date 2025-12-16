<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Tampilkan semua data warga
     */
    public function index(Request $request)
    {
        //Daftar kolom yang bisa difilter sesuai pada form pencarian
        $filterableColumns = ['jenis_kelamin'];

        //Search
        $searchableColumns = [
            'no_ktp',
            'nama',
            'jenis_kelamin',
            'agama',
            'pekerjaan',
            'telp',
            'email',
        ];

        //Gunakan scope filter pada model Warga untuk memproses query filter
        $warga = Warga::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->simplePaginate(10);

        return view('Pages.Admin.warga.index', compact('warga'));
    }

    /**
     * Form tambah data warga
     */
    public function create()
    {
        return view('pages.admin.warga.create');
    }

    /**
     * Simpan data warga baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_ktp'        => 'required|unique:warga',
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'agama'         => 'required|string|max:100',
            'pekerjaan'     => 'required|string|max:150',
            'telp'          => 'nullable|string|max:20',
            'email'         => 'nullable|email',
        ]);

        Warga::create($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan!');
    }

    /**
     * Form edit data warga
     */
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.admin.warga.edit', compact('warga'));
    }
    public function show($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.admin.warga.show', compact('warga'));
    }
    /**
     * Update data warga
     */
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $request->validate([
            'no_ktp'        => 'required|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'agama'         => 'required|string|max:100',
            'pekerjaan'     => 'required|string|max:150',
            'telp'          => 'nullable|string|max:20',
            'email'         => 'nullable|email',
        ]);

        $warga->update($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui!');
    }

    /**
     * Hapus data warga
     */
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
    
}
