<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahapanProyek;
use App\Models\Proyek;

class TahapanProyekController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['nama_tahap'];
        $searchableColumns = ['proyek_id','nama_tahap','target_persen','tgl_mulai','tgl_selesai'];

        $tahapan = TahapanProyek::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->simplePaginate(10);

        return view('pages.admin.tahapan.index', compact('tahapan'));
    }

    public function create()
    {
        $proyek = Proyek::all();
        $pilihanTahap = ['Perencanaan','Persiapan','Pelaksanaan','Pengawasan','Penyelesaian'];
        return view('pages.admin.tahapan.create', compact('proyek', 'pilihanTahap'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyek_id' => 'required',
            'nama_tahap' => 'required',
            'target_persen' => 'required|numeric',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
        ]);

        $tahapan = TahapanProyek::create($request->all());

        // Upload file jika ada
        if($request->hasFile('files')){
            $mediaRequest = $request->merge([
                'ref_table' => 'tahapan',
                'ref_id' => $tahapan->tahap_id
            ]);
            app(\App\Http\Controllers\MediaController::class)->store($mediaRequest);
        }

        return redirect()->route('tahapan.index')->with('success', 'Tahapan proyek berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tahapan = TahapanProyek::findOrFail($id);
        $proyek = Proyek::all();
        $pilihanTahap = ['Perencanaan','Persiapan','Pelaksanaan','Pengawasan','Penyelesaian'];

        return view('pages.admin.tahapan.edit', compact('tahapan', 'proyek', 'pilihanTahap'));
    }

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

        // Upload file baru jika ada
        if($request->hasFile('files')){
            $mediaRequest = $request->merge([
                'ref_table' => 'tahapan',
                'ref_id' => $tahapan->tahap_id
            ]);
            app(\App\Http\Controllers\MediaController::class)->store($mediaRequest);
        }

        return redirect()->route('tahapan.index')->with('success', 'Tahapan proyek berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tahapan = TahapanProyek::findOrFail($id);

        // Hapus media terkait
        foreach($tahapan->media as $media){
            app(\App\Http\Controllers\MediaController::class)->destroy($media->media_id);
        }

        $tahapan->delete();

        return redirect()->route('tahapan.index')->with('success', 'Tahapan proyek berhasil dihapus.');
    }

    public function show($id)
    {
        $tahapan = TahapanProyek::with(['proyek','media'])->findOrFail($id);
        return view('pages.admin.tahapan.show', compact('tahapan'));
    }
}
