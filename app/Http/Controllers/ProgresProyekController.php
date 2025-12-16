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
    public function index(Request $request)
    {
        $filterableColumns = ['proyek_id','tahap_id'];
        $searchableColumns = ['catatan'];

        $progres = ProgresProyek::with(['proyek','tahapan','media'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->simplePaginate(10);

        $proyeks = Proyek::all();
        $tahaps  = TahapanProyek::all();

        return view('pages.admin.progres_proyek.index', compact('progres','proyeks','tahaps'));
    }

    public function create()
    {
        $proyeks = Proyek::all();
        $tahaps  = TahapanProyek::all();
        return view('pages.admin.progres_proyek.create', compact('proyeks','tahaps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyek_id'   => 'required|exists:proyek,proyek_id',
            'tahap_id'    => 'required|exists:tahapan_proyek,tahap_id',
            'persen_real' => 'required|numeric|min:0|max:100',
            'tanggal'     => 'required|date',
            'catatan'     => 'nullable',
            'files.*'     => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120'
        ]);

        $progres = ProgresProyek::create($request->only('proyek_id','tahap_id','persen_real','tanggal','catatan'));

        // Simpan file dengan mime_type
        if($request->hasFile('files')){
            foreach($request->file('files') as $file){
                $filename = time().'_'.$file->getClientOriginalName();
                $file->storeAs('public/uploads/progres', $filename);

                Media::create([
                    'ref_table' => 'progres_proyek',
                    'ref_id'    => $progres->progres_id,
                    'file_url'  => $filename,
                    'caption'   => null,
                    'mime_type' => $file->getMimeType(), // wajib untuk field mime_type
                ]);
            }
        }

        return redirect()->route('progres_proyek.index')->with('success','Progres berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item    = ProgresProyek::with('media')->findOrFail($id);
        $proyeks = Proyek::all();
        $tahaps  = TahapanProyek::all();
        return view('pages.admin.progres_proyek.edit', compact('item','proyeks','tahaps'));
    }

    public function update(Request $request, $id)
    {
        $item = ProgresProyek::findOrFail($id);

        $request->validate([
            'proyek_id'   => 'required|exists:proyek,proyek_id',
            'tahap_id'    => 'required|exists:tahapan_proyek,tahap_id',
            'persen_real' => 'required|numeric|min:0|max:100',
            'tanggal'     => 'required|date',
            'catatan'     => 'nullable',
            'files.*'     => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120'
        ]);

        $item->update($request->only('proyek_id','tahap_id','persen_real','tanggal','catatan'));

        if($request->hasFile('files')){
            foreach($request->file('files') as $file){
                $filename = time().'_'.$file->getClientOriginalName();
                $file->storeAs('public/uploads/progres', $filename);

                Media::create([
                    'ref_table' => 'progres_proyek',
                    'ref_id'    => $item->progres_id,
                    'file_url'  => $filename,
                    'caption'   => null,
                    'mime_type' => $file->getMimeType(),
                ]);
            }
        }

        return redirect()->route('progres_proyek.index')->with('success','Progres berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = ProgresProyek::with('media')->findOrFail($id);

        // Hapus semua file media dari storage
        foreach($item->media as $file){
            Storage::delete('public/uploads/progres/'.$file->file_url);
            $file->delete();
        }

        $item->delete();
        return redirect()->route('progres_proyek.index')->with('success','Progres berhasil dihapus!');
    }

    // Hapus file individual
    public function destroyFile($media_id)
    {
        $media = Media::findOrFail($media_id);
        Storage::delete('public/uploads/progres/'.$media->file_url);
        $media->delete();

        return back()->with('success','File berhasil dihapus!');
    }

    public function show($id)
    {
        $item = ProgresProyek::with('media','proyek','tahapan')->findOrFail($id);
        return view('pages.admin.progres_proyek.show', compact('item'));
    }
}
