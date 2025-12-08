<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua user
     */
    public function index(Request $request)
    {
        //Daftar kolom yang bisa difilter sesuai pada form pencarian
        $filterableColumns = ['email'];

        // Search
        $searchableColumns = [
            'name',
            'email',
        ];

        //Gunakan scope filter pada model User untuk memproses query filter
        $users = User::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->simplePaginate(10);
        return view('pages.admin.user.index', compact('users'));
    }
    /**
     * Menampilkan form tambah user
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Menyimpan user baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,staff,user',
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ];

        User::create($data);

        // return view('pages.admin.user.index')->with('success', 'User berhasil ditambahkan!');
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit user
     */
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

    /**
     * Update data user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role'     => 'required|in:admin,staff,user',
        ]);

        $data = $request->only(['name', 'email', 'role']);

        // Jika password diisi, otomatis di-hash karena cast
        if ($request->filled('password')) {
            $data['password'] = $request->password;

        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Hapus user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
