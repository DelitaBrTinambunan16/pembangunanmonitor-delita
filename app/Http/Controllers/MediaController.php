<?php
namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ref_table' => 'required|string',
            'ref_id'    => 'required|integer',
            'files'     => 'required',
            'files.*'   => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:4096',
        ]);

        $files = is_array($request->file('files'))
            ? $request->file('files')
            : [$request->file('files')];

        $uploadedFiles = [];

        foreach ($files as $index => $file) {

            // nama file asli
            $originalName = $file->getClientOriginalName();

            // buat nama unik
            $fileurl = time() . '_' . $index . '_' . $originalName;

            // folder berdasarkan ref_table (contoh: proyek/, progres_proyek/, lokasi_proyek/)
            $file->storeAs('uploads/' . $request->ref_table, $fileurl, 'public');

            // simpan metadata (PAKAI FILE_NAME sesuai soal)
            $media = Media::create([
                'ref_table'  => $request->ref_table,
                'ref_id'     => $request->ref_id,
                'file_url'  => $fileurl,
                'caption'    => $request->caption[$index] ?? null,
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

    public function getByReference($table, $id)
    {
        return Media::where('ref_table', $table)
            ->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();
    }

    public function destroy($id)
    {
        $file = DB::table('media')->where('media_id', $id)->first();

        if ($file) {
            $path = public_path('uploads/' . $file->file_url);
            if (file_exists($path)) {
                unlink($path);
            }
            DB::table('media')->where('media_id', $id)->delete();
        }

        return back()->with('success', 'File berhasil dihapus.');
    }

}
