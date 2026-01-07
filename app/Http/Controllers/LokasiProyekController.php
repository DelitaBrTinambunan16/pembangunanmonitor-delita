<?php

namespace App\Http\Controllers;

use App\Models\LokasiProyek;
use App\Models\Proyek;
use Illuminate\Http\Request;

class LokasiProyekController extends Controller
{
    public function index(Request $request)
    {
        $lokasis = LokasiProyek::with(['proyek','media'])
            ->when($request->filled('proyek_id'), fn ($q) =>
                $q->where('proyek_id', $request->proyek_id)
            )
            ->when($request->filled('search'), fn ($q) =>
                $q->where('lat', 'like', "%{$request->search}%")
                  ->orWhere('lng', 'like', "%{$request->search}%")
                  ->orWhere('geojson', 'like', "%{$request->search}%")
            )
            ->simplePaginate(10)
            ->withQueryString();

        $proyekList = Proyek::all();

        return view('pages.admin.lokasi_proyek.index', compact('lokasis','proyekList'));
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
            'files.*'   => 'file|mimes:jpg,jpeg,png,pdf|max:20480',
        ]);

        // SIMPAN DATA LOKASI
        $lokasi = LokasiProyek::create(
            $request->only(['proyek_id','lat','lng','geojson'])
        );

        // SIMPAN MEDIA (FIX TOTAL)
        if ($request->hasFile('files')) {
            $mediaRequest = new Request([
                'ref_table' => 'lokasi',
                'ref_id'    => $lokasi->lokasi_id,
            ]);

            $mediaRequest->files->set('files', $request->file('files'));

            app(\App\Http\Controllers\MediaController::class)
                ->store($mediaRequest);
        }

        return redirect()->route('lokasi.index')
            ->with('success','Lokasi berhasil ditambahkan');
    }

    public function show($id)
    {
        $item = LokasiProyek::with(['proyek','media'])->findOrFail($id);
        return view('pages.admin.lokasi_proyek.show', compact('item'));
    }

    public function edit($id)
    {
        $item = LokasiProyek::with('media')->findOrFail($id);
        $proyekList = Proyek::orderBy('nama_proyek')->get();

        return view('pages.admin.lokasi_proyek.edit', compact('item','proyekList'));
    }

    public function update(Request $request, $id)
    {
        $lokasi = LokasiProyek::findOrFail($id);

        $request->validate([
            'proyek_id' => 'required|exists:proyek,proyek_id',
            'lat'       => 'nullable|numeric',
            'lng'       => 'nullable|numeric',
            'geojson'   => 'nullable|string',
            'files.*'   => 'file|mimes:jpg,jpeg,png,pdf|max:20480',
        ]);

        $lokasi->update(
            $request->only(['proyek_id','lat','lng','geojson'])
        );

        // TAMBAH MEDIA BARU (FIX TOTAL)
        if ($request->hasFile('files')) {
            $mediaRequest = new Request([
                'ref_table' => 'lokasi',
                'ref_id'    => $lokasi->lokasi_id,
            ]);

            $mediaRequest->files->set('files', $request->file('files'));

            app(\App\Http\Controllers\MediaController::class)
                ->store($mediaRequest);
        }

        return redirect()->route('lokasi.edit', $lokasi->lokasi_id)
            ->with('success','Lokasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $lokasi = LokasiProyek::with('media')->findOrFail($id);

        foreach ($lokasi->media as $media) {
            app(\App\Http\Controllers\MediaController::class)
                ->destroy($media->media_id);
        }

        $lokasi->delete();

        return redirect()->route('lokasi.index')
            ->with('success','Lokasi berhasil dihapus');
    }
}
