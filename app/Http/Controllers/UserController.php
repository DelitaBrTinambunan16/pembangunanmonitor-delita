<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['email'];
        $searchableColumns = ['name', 'email'];

        $users = User::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->simplePaginate(10);

        return view('pages.admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|string|min:6',
            'role'            => 'required|in:admin,staff,user',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');

            if ($file->isValid()) {
                $path = $file->store('profile_pictures', 'public');

                // simpan path foto pada tabel user
                $user->update(['profile_picture' => $path]);

                // simpan media baru
                Media::create([
                    'ref_table'  => 'users',
                    'ref_id'     => $user->id,
                    'file_url'   => 'storage/' . $path, // konsisten dengan MediaController
                    'caption'    => 'Profile picture of ' . $user->name,
                    'mime_type'  => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }
        }

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.user.edit', compact('user'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.user.show', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email,' . $id,
            'password'        => 'nullable|string|min:6',
            'role'            => 'required|in:admin,staff,user',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data = $request->only(['name', 'email', 'role']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        /**
         * ================= FOTO USER & MEDIA =================
         */
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');

            if ($file->isValid()) {

                // Hapus file lama jika ada
                if ($user->profile_picture) {
                    Storage::disk('public')->delete($user->profile_picture);
                }

                // Upload baru
                $path = $file->store('profile_pictures', 'public');
                $data['profile_picture'] = $path;

                // Hapus media lama
                Media::where('ref_table', 'users')
                    ->where('ref_id', $user->id)
                    ->delete();

                // Simpan media baru
                Media::create([
                    'ref_table'  => 'users',
                    'ref_id'     => $user->id,
                    'file_url'   => 'storage/' . $path, // konsisten
                    'caption'    => 'Profile picture of ' . $user->name,
                    'mime_type'  => $file->getMimeType(),
                    'sort_order' => 1,
                ]);
            }
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus media terkait
        $mediaList = Media::where('ref_table', 'users')
            ->where('ref_id', $id)
            ->get();

        foreach ($mediaList as $media) {
            $relativePath = str_replace('storage/', '', $media->file_url);

            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }

            $media->delete();
        }

        // Hapus foto profil
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
