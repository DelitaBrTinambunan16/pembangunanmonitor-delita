<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Media;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['sumber_dana'];

        $searchableColumns = [
            'nama_proyek',
            'lokasi',
            'tahun',
            'kode_proyek',
            'anggaran',
            'sumber_dana',
            'deskripsi',
        ];

        // Ambil semua tahun unik untuk filter dropdown
        $tahunList = Proyek::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        $proyeks = Proyek::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->simplePaginate(10);

        return view('pages.admin.proyek.index', compact('proyeks', 'tahunList'));
    }

    public function create()
    {
        return view('pages.admin.proyek.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_proyek' => 'required',
            'nama_proyek' => 'required',
            'tahun' => 'required',
            'anggaran' => 'required',
            'sumber_dana' => 'required',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:5120'
        ]);

        // Simpan data proyek
        $proyek = Proyek::create([
            'kode_proyek' => $request->kode_proyek,
            'nama_proyek' => $request->nama_proyek,
            'tahun' => $request->tahun,
            'anggaran' => $request->anggaran,
            'sumber_dana' => $request->sumber_dana,
            'deskripsi' => $request->deskripsi,
        ]);

        // Multiple upload
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {

                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);

                $fileurl = 'uploads/' . $filename; // perbaikan: definisikan file_url

                Media::create([
                    'ref_table' => 'proyek',
                    'ref_id'    => $proyek->proyek_id,
                    'file_url'  => $fileurl,
                    'caption'   => 'Upload Proyek',
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order'=> 1,
                ]);
            }
        }

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil ditambahkan!');
    }

public function show($id)
{
    $proyek = Proyek::with([
        'kontraktor',     // relasi kontraktor
        'tahapan',        // relasi tahapan
        'progres.tahapan',   // progres + relasi ke nama tahapan
        'lokasiProyek',         // relasi lokasi
        'media'            // dokumen proyek
    ])->findOrFail($id);

    return view('pages.admin.proyek.show', compact('proyek'));
}


    public function edit($id)
    {
        $proyek = Proyek::findOrFail($id);

        return view('pages.admin.proyek.edit', compact('proyek'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_proyek' => 'required',
            'nama_proyek' => 'required',
            'tahun' => 'required',
            'anggaran' => 'required',
            'sumber_dana' => 'required',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:5120'
        ]);

        $proyek = Proyek::findOrFail($id);

        // Update data proyek
        $proyek->update([
            'kode_proyek' => $request->kode_proyek,
            'nama_proyek' => $request->nama_proyek,
            'tahun' => $request->tahun,
            'anggaran' => $request->anggaran,
            'sumber_dana' => $request->sumber_dana,
            'deskripsi' => $request->deskripsi,
        ]);

        // Upload file baru jika ada
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {

                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);

                $fileurl = 'uploads/' . $filename; // definisikan file_url

                Media::create([
                    'ref_table' => 'proyek',
                    'ref_id'    => $proyek->proyek_id,
                    'file_url'  => $fileurl,
                    'caption'   => 'Upload Proyek',
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order'=> 1,
                ]);
            }
        }

        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $proyek = Proyek::findOrFail($id);
        $proyek->delete();

        return redirect()->route('proyek.index')->with('success', 'Data proyek berhasil dihapus!');
    }
}
