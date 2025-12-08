<?php
namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard dengan data dari database.
     */
    public function index()
    {
        // Kalau belum login, arahkan ke halaman login
        if (! Auth::check()) {
            return redirect()->route('login')->withErrors('Silahkan login terlebih dahulu.');
        }

        // Hitung total data di setiap tabel
        $totalProyek = Proyek::count();
        $totalUser   = User::count();
        $totalWarga  = Warga::count();

        // Ambil 5 proyek terbaru
        $proyekAktif = Proyek::orderBy('created_at', 'desc')->take(5)->get();

        // Data per tahun untuk Chart
        $proyekPerTahun = Proyek::selectRaw('tahun, COUNT(*) as jumlah')
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->pluck('jumlah', 'tahun')
            ->toArray();

        return view('pages.dashboard', compact(
            'totalProyek', 'totalUser', 'totalWarga', 'proyekAktif', 'proyekPerTahun'
        ));
    }

    public function create()
    {}
    public function store(Request $request)
    {}
    public function show(string $id)
    {}
    public function edit(string $id)
    {}
    public function update(Request $request, string $id)
    {}
    public function destroy(string $id)
    {}
}
