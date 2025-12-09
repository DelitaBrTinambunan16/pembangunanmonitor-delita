<?php
namespace App\Http\Controllers;

use App\Models\ProgresProyek;
use App\Models\Proyek;
use App\Models\TahapanProyek;
use Illuminate\Http\Request;

class ProgresProyekController extends Controller
{
    public function index(Request $request)
    {
        // Kolom filter
        $filterableColumns = ['proyek_id', 'tahap_id'];
        $searchableColumns = ['catatan'];

        // Ambil data progres proyek dengan filter & search
        $progres = ProgresProyek::with(['proyek', 'tahap'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->simplePaginate(10);

        // Ambil semua proyek & tahapan untuk dropdown filter
        $proyeks = Proyek::all();
        $tahaps  = TahapanProyek::all();

        return view('pages.admin.progres_proyek.index', compact('progres', 'proyeks', 'tahaps'));
    }

    public function create()
    {
        $proyeks = Proyek::all();
        $tahaps  = TahapanProyek::all();
        return view('pages.admin.progres_proyek.create', compact('proyeks', 'tahaps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyek_id'   => 'required|exists:proyek,proyek_id',
            'tahap_id'    => 'required|exists:tahapan_proyek,tahap_id',
            'persen_real' => 'required|numeric|min:0|max:100',
            'tanggal'     => 'required|date',
            'catatan'     => 'nullable',
        ]);

        ProgresProyek::create($request->all());
        return redirect()->route('progres_proyek.index')->with('success', 'Progres berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item    = ProgresProyek::findOrFail($id);
        $proyeks = Proyek::all();
        $tahaps  = TahapanProyek::all();
        return view('pages.admin.progres_proyek.edit', compact('item', 'proyeks', 'tahaps'));
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
        ]);

        $item->update($request->all());
        return redirect()->route('progres_proyek.index')->with('success', 'Progres berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = ProgresProyek::findOrFail($id);
        $item->delete();
        return redirect()->route('progres_proyek.index')->with('success', 'Progres berhasil dihapus!');
    }
}
