<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    /**
     * Upload media (multi file)
     */
    public function store(Request $request)
    {
        $request->validate([
            'ref_table' => 'required|string',
            'ref_id'    => 'required|integer',
            'files'     => 'required',
            'files.*'   => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:4096',
        ]);

        $files = is_array($request->file('files'))
            ? $request->file('files')
            : [$request->file('files')];

        $uploaded = [];

        foreach ($files as $index => $file) {

            $fileName = time() . '_' . $index . '_' . $file->getClientOriginalName();

            // path fisik (storage)
            $file->storeAs(
                'uploads/' . $request->ref_table,
                $fileName,
                'public'
            );

            // path publik (untuk asset())
            $publicPath = 'storage/uploads/' . $request->ref_table . '/' . $fileName;

            $media = Media::create([
                'ref_table'  => $request->ref_table,
                'ref_id'     => $request->ref_id,
                'file_url'   => $publicPath,
                'caption'    => $request->caption[$index] ?? null,
                'mime_type'  => $file->getClientMimeType(),
                'sort_order' => Media::where('ref_table', $request->ref_table)
                    ->where('ref_id', $request->ref_id)
                    ->count() + 1,
            ]);

            $uploaded[] = $media;
        }

        return response()->json([
            'message' => 'Upload berhasil',
            'data'    => $uploaded,
        ]);
    }

    /**
     * Ambil media berdasarkan ref_table & ref_id
     */
    public function getByReference($table, $id)
    {
        return Media::where('ref_table', $table)
            ->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Hapus media
     */
    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        // hapus file fisik
        $relativePath = str_replace('storage/', '', $media->file_url);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }

        $media->delete();

        return back()->with('success', 'File berhasil dihapus.');
    }
}
