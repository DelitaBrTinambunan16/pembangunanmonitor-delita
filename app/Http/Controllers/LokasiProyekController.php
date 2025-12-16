<?php
namespace App\Http\Controllers;

use App\Models\LokasiProyek;
use App\Models\Proyek;
use Illuminate\Http\Request;

class LokasiProyekController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['proyek_id'];
        $searchableColumns = ['lat', 'lng', 'geojson'];

        $lokasis = LokasiProyek::with('proyek')
            ->when($request->filled('proyek_id'), fn($q) => $q->where('proyek_id', $request->proyek_id))
            ->when($request->filled('search'), function ($q) use ($request, $searchableColumns) {
                $q->where(function ($q2) use ($request, $searchableColumns) {
                    foreach ($searchableColumns as $col) {
                        $q2->orWhere($col, 'like', '%' . $request->search . '%');
                    }
                });
            })
            ->simplePaginate(10)
            ->withQueryString();

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
            'files.*'   => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xlsx|max:20480',
        ]);

        $uploadedFiles = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/uploads/lokasi_proyek', $fileName);
                $uploadedFiles[] = $fileName;
            }
        }

        LokasiProyek::create(array_merge(
            $request->only(['proyek_id', 'lat', 'lng', 'geojson']),
            ['files' => $uploadedFiles]
        ));

        return redirect()->route('lokasi_proyek.index')->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function show($id)
    {
        $item = LokasiProyek::findOrFail($id);
        return view('pages.admin.lokasi_proyek.show', compact('item'));
    }

    public function edit($id)
    {
        $item       = LokasiProyek::with('media')->findOrFail($id);
        $proyekList = Proyek::orderBy('nama_proyek')->get();

        return view('pages.admin.lokasi_proyek.edit', compact(
            'item',
            'proyekList'
        ));
    }

    public function update(Request $request, $id)
    {
        $lokasi = LokasiProyek::findOrFail($id);

        $request->validate([
            'proyek_id' => 'required|exists:proyek,proyek_id',
            'lat'       => 'nullable|numeric',
            'lng'       => 'nullable|numeric',
            'geojson'   => 'nullable|string',
            'files.*'   => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xlsx|max:20480',
        ]);

        $existingFiles = $lokasi->files ?? [];
        $uploadedFiles = $existingFiles;

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/uploads/lokasi_proyek', $fileName);
                $uploadedFiles[] = $fileName;
            }
        }

        $lokasi->update(array_merge(
            $request->only(['proyek_id', 'lat', 'lng', 'geojson']),
            ['files' => $uploadedFiles]
        ));

        return redirect()->route('lokasi_proyek.edit', $lokasi->lokasi_id)->with('success', 'Lokasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $lokasi = LokasiProyek::findOrFail($id);

        // hapus semua file
        foreach ($lokasi->files ?? [] as $file) {
            $path = storage_path('app/public/uploads/lokasi_proyek/' . $file);
            if (file_exists($path)) {
                unlink($path);
            }

        }

        $lokasi->delete();
        return redirect()->route('lokasi_proyek.index')->with('success', 'Lokasi berhasil dihapus!');
    }

    // Hapus satu file
    public function destroyFile($id, $filename)
    {
        $lokasi = LokasiProyek::findOrFail($id);
        $files  = $lokasi->files ?? [];

        if (in_array($filename, $files)) {
            $path = storage_path('app/public/uploads/lokasi_proyek/' . $filename);
            if (file_exists($path)) {
                unlink($path);
            }

            $files = array_filter($files, fn($f) => $f !== $filename);
            $lokasi->update(['files' => array_values($files)]);
        }

        return back()->with('success', 'File berhasil dihapus!');
    }
}
