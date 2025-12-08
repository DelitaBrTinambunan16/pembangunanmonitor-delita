<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Upload 1 atau banyak foto
     */
    public function store(Request $request)
    {
        $request->validate([
            'ref_table' => 'required|string',
            'ref_id'    => 'required|integer',
            'files'     => 'required',
            'files.*'   => 'image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        // Pastikan input file adalah array, jika single file ubah jadi array
        $files = is_array($request->file('files'))
            ? $request->file('files')
            : [$request->file('files')];

        $uploadedFiles = [];

        foreach ($files as $file) {

            // Simpan file ke storage/app/public/uploads
            $path = $file->store('uploads', 'public');

            // Simpan metadata ke DB
            $media = Media::create([
                'ref_table'  => $request->ref_table,
                'ref_id'     => $request->ref_id,
                'file_url'   => 'storage/' . $path,
                'caption'    => $request->caption ?? null,
                'mime_type'  => $file->getClientMimeType(),
                'sort_order' => Media::where('ref_table', $request->ref_table)
                                     ->where('ref_id', $request->ref_id)
                                     ->count() + 1,
            ]);

            $uploadedFiles[] = $media;
        }

        return response()->json([
            'message' => 'Upload berhasil',
            'data'    => $uploadedFiles,
        ]);
    }

    /**
     * Ambil semua foto berdasarkan ref_table & ref_id
     */
    public function getByReference($table, $id)
    {
        $media = Media::where('ref_table', $table)
                      ->where('ref_id', $id)
                      ->orderBy('sort_order')
                      ->get();

        return response()->json($media);
    }

    /**
     * Hapus media berdasarkan ID
     */
    public function destroy($media_id)
    {
        $media = Media::findOrFail($media_id);

        // Path asli tanpa "storage/"
        $storedPath = str_replace('storage/', '', $media->file_url);

        // Hapus file fisik jika ada
        if (Storage::disk('public')->exists($storedPath)) {
            Storage::disk('public')->delete($storedPath);
        }

        // Hapus record DB
        $media->delete();

        return response()->json(['message' => 'Media berhasil dihapus']);
    }
}
