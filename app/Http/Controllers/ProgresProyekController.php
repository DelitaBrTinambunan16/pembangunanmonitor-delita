<?php

namespace App\Http\Controllers;

use App\Models\ProgresProyek;
use App\Models\Proyek;
use App\Models\TahapanProyek;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgresProyekController extends Controller
{
    // ============================
    // INDEX
    // ============================
    public function index(Request $request)
    {
        $progres = ProgresProyek::with(['proyek','tahapan','media'])
            ->when($request->filled('proyek_id'), fn($q) =>
                $q->where('proyek_id', $request->proyek_id)
            )
            ->when($request->filled('tahap_id'), fn($q) =>
                $q->where('tahap_id', $request->tahap_id)
            )
            ->when($request->filled('search'), fn($q) =>
                $q->where('catatan','like','%'.$request->search.'%')
            )
            ->simplePaginate(10)
            ->withQueryString();

        $proyeks = Proyek::all();
        $tahaps  = TahapanProyek::all();

        return view('pages.admin.progres_proyek.index', compact(
            'progres','proyeks','tahaps'
        ));
    }

    // ============================
    // CREATE
    // ============================
    public function create()
    {
        return view('pages.admin.progres_proyek.create', [
            'proyeks' => Proyek::all(),
            'tahaps'  => TahapanProyek::all(),
        ]);
    }

    // ============================
    // STORE (🔥 FIX TOTAL)
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'proyek_id'   => 'required|exists:proyek,proyek_id',
            'tahap_id'    => 'required|exists:tahapan_proyek,tahap_id',
            'persen_real' => 'required|numeric|min:0|max:100',
            'tanggal'     => 'required|date',
            'catatan'     => 'nullable',
            'files.*'     => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        // SIMPAN DATA PROGRES
        $progres = ProgresProyek::create(
            $request->only([
                'proyek_id',
                'tahap_id',
                'persen_real',
                'tanggal',
                'catatan'
            ])
        );

        // 🔥 SIMPAN MEDIA (SAMA SEPERTI TAHAPAN & LOKASI)
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {

                $fileName = time().'_'.$index.'_'.$file->getClientOriginalName();

                $file->storeAs(
                    'uploads/progres',
                    $fileName,
                    'public'
                );

                Media::create([
                    'ref_table' => 'progres', // 🔥 HARUS "progres"
                    'ref_id'    => $progres->progres_id,
                    'file_url'  => 'storage/uploads/progres/'.$fileName, // 🔥 PATH PUBLIK
                    'caption'   => null,
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order'=> Media::where('ref_table','progres')
                        ->where('ref_id',$progres->progres_id)
                        ->count() + 1,
                ]);
            }
        }

        return redirect()
            ->route('progres_proyek.index')
            ->with('success','Progres berhasil ditambahkan!');
    }

    // ============================
    // EDIT
    // ============================
    public function edit($id)
    {
        return view('pages.admin.progres_proyek.edit', [
            'item'    => ProgresProyek::with('media')->findOrFail($id),
            'proyeks' => Proyek::all(),
            'tahaps'  => TahapanProyek::all(),
        ]);
    }

    // ============================
    // UPDATE (🔥 FIX TOTAL)
    // ============================
    public function update(Request $request, $id)
    {
        $item = ProgresProyek::findOrFail($id);

        $request->validate([
            'proyek_id'   => 'required|exists:proyek,proyek_id',
            'tahap_id'    => 'required|exists:tahapan_proyek,tahap_id',
            'persen_real' => 'required|numeric|min:0|max:100',
            'tanggal'     => 'required|date',
            'catatan'     => 'nullable',
            'files.*'     => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        $item->update(
            $request->only([
                'proyek_id',
                'tahap_id',
                'persen_real',
                'tanggal',
                'catatan'
            ])
        );

        // TAMBAH FILE BARU (TIDAK MENIMPA)
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {

                $fileName = time().'_'.$index.'_'.$file->getClientOriginalName();

                $file->storeAs(
                    'uploads/progres',
                    $fileName,
                    'public'
                );

                Media::create([
                    'ref_table' => 'progres',
                    'ref_id'    => $item->progres_id,
                    'file_url'  => 'storage/uploads/progres/'.$fileName,
                    'caption'   => null,
                    'mime_type' => $file->getClientMimeType(),
                    'sort_order'=> Media::where('ref_table','progres')
                        ->where('ref_id',$item->progres_id)
                        ->count() + 1,
                ]);
            }
        }

        return redirect()
            ->route('progres_proyek.index')
            ->with('success','Progres berhasil diperbarui!');
    }

    // ============================
    // SHOW
    // ============================
    public function show($id)
    {
        $item = ProgresProyek::with(['media','proyek','tahapan'])
            ->findOrFail($id);

        return view('pages.admin.progres_proyek.show', compact('item'));
    }

    // ============================
    // DESTROY
    // ============================
    public function destroy($id)
    {
        $item = ProgresProyek::with('media')->findOrFail($id);

        foreach ($item->media as $media) {
            $path = str_replace('storage/', '', $media->file_url);
            Storage::disk('public')->delete($path);
            $media->delete();
        }

        $item->delete();

        return redirect()
            ->route('progres_proyek.index')
            ->with('success','Progres berhasil dihapus!');
    }

    // ============================
    // HAPUS FILE INDIVIDUAL
    // ============================
    public function destroyFile($media_id)
    {
        $media = Media::findOrFail($media_id);

        $path = str_replace('storage/', '', $media->file_url);
        Storage::disk('public')->delete($path);

        $media->delete();

        return back()->with('success','File berhasil dihapus!');
    }
}
