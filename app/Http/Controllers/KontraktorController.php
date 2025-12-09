<?php
namespace App\Http\Controllers;

use App\Models\Kontraktor;
use App\Models\Proyek;
use Illuminate\Http\Request;

class KontraktorController extends Controller
{
    public function index(Request $request)
    {
        // Kolom yang bisa difilter (contoh: filter proyek)
        $filterableColumns = ['proyek_id'];

        // Kolom yang bisa dicari
        $searchableColumns = ['nama', 'penanggung_jawab'];

        // Ambil data kontraktor dengan filter & search
        $kontraktors = Kontraktor::with('proyek')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->simplePaginate(10);

        // Ambil semua proyek untuk dropdown filter
        $proyeks = Proyek::all();

        return view('pages.admin.kontraktor.index', compact('kontraktors','proyeks'));
    }

    public function create()
    {
        $proyeks = Proyek::all();
        return view('pages.admin.kontraktor.create', compact('proyeks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyek_id'        => 'required|exists:proyek,proyek_id',
            'nama'             => 'required|string|max:255',
            'penanggung_jawab' => 'nullable|string|max:255',
            'kontak'           => 'nullable|string|max:255',
            'alamat'           => 'nullable',
        ]);

        Kontraktor::create($request->all());
        return redirect()->route('kontraktor.index')->with('success', 'Kontraktor berhasil ditambahkan!');
    }

    public function show($id)
    {
        $item = Kontraktor::with('proyek')->findOrFail($id);
        return view('pages.admin.kontraktor.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Kontraktor::findOrFail($id);
        $proyeks = Proyek::all();
        return view('pages.admin.kontraktor.edit', compact('item', 'proyeks'));
    }

    public function update(Request $request, $id)
    {
        $item = Kontraktor::findOrFail($id);

        $request->validate([
            'proyek_id'        => 'required|exists:proyek,proyek_id',
            'nama'             => 'required|string|max:255',
            'penanggung_jawab' => 'nullable|string|max:255',
            'kontak'           => 'nullable|string|max:255',
            'alamat'           => 'nullable',
        ]);

        $item->update($request->all());
        return redirect()->route('kontraktor.index')->with('success', 'Kontraktor berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = Kontraktor::findOrFail($id);
        $item->delete();
        return redirect()->route('kontraktor.index')->with('success', 'Kontraktor berhasil dihapus!');
    }
}
