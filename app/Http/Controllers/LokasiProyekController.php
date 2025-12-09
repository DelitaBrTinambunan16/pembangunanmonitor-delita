<?php
namespace App\Http\Controllers;

use App\Models\LokasiProyek;
use App\Models\Proyek;
use Illuminate\Http\Request;

class LokasiProyekController extends Controller
{
    public function index(Request $request)
    {
        // Daftar kolom yang bisa difilter (misal filter berdasarkan proyek)
        $filterableColumns = ['proyek_id'];

        // Kolom yang bisa dicari (search)
        $searchableColumns = [
            'lat',
            'lng',
            'geojson',
        ];

        // Query lokasi proyek dengan eager load proyek
        $lokasis = LokasiProyek::with('proyek')
            ->when($request->filled('proyek_id'), function ($query) use ($request) {
                $query->where('proyek_id', $request->proyek_id);
            })
            ->when($request->filled('search'), function ($query) use ($request, $searchableColumns) {
                $query->where(function ($q) use ($request, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $q->orWhere($column, 'like', '%' . $request->search . '%');
                    }
                });
            })
            ->simplePaginate(10)
            ->withQueryString();

        // Ambil semua proyek untuk filter dropdown
        $proyekList = Proyek::all();

        return view('pages.admin.lokasi_proyek.index', compact('lokasis', 'proyekList'));
    }

    public function create()
    {
        $proyeks = Proyek::all();
        return view('pages.admin.lokasi_proyek.create', compact('proyeks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyek_id' => 'required|exists:proyek,proyek_id',
            'lat'       => 'nullable|numeric',
            'lng'       => 'nullable|numeric',
            'geojson'   => 'nullable|string',
        ]);

        LokasiProyek::create($request->all());
        return redirect()->route('lokasi_proyek.index')->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function show($id)
    {
        $item = LokasiProyek::with('proyek')->findOrFail($id);
        return view('pages.admin.lokasi_proyek.show', compact('item'));
    }

    public function edit($id)
    {
        $item    = LokasiProyek::findOrFail($id);
        $proyeks = Proyek::all();
        return view('pages.admin.lokasi_proyek.edit', compact('item', 'proyeks'));
    }

    public function update(Request $request, $id)
    {
        $item = LokasiProyek::findOrFail($id);

        $request->validate([
            'proyek_id' => 'required|exists:proyek,proyek_id',
            'lat'       => 'nullable|numeric',
            'lng'       => 'nullable|numeric',
            'geojson'   => 'nullable|string',
        ]);

        $item->update($request->all());
        return redirect()->route('lokasi_proyek.index')->with('success', 'Lokasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = LokasiProyek::findOrFail($id);
        $item->delete();
        return redirect()->route('lokasi_proyek.index')->with('success', 'Lokasi berhasil dihapus!');
    }
}
