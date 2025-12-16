<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Proteksi login
        if (!Auth::check()) {
            return redirect()->route('login')
                ->withErrors('Silakan login terlebih dahulu.');
        }

        // ================= STATISTIK UTAMA =================
        $totalProyek = Proyek::count();
        $totalUser   = User::count();
        $totalWarga  = Warga::count();

        // ================= PROYEK TERBARU =================
        $proyekAktif = Proyek::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // ================= GRAFIK PROYEK PER TAHUN =================
        // hasil: Collection [tahun => jumlah]
        $proyekPerTahun = Proyek::selectRaw('tahun, COUNT(*) as jumlah')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->pluck('jumlah', 'tahun');

        // ================= GRAFIK SUMBER DANA =================
        // hasil: Collection [sumber_dana => jumlah]
        $sumberDana = Proyek::selectRaw('sumber_dana, COUNT(*) as jumlah')
            ->groupBy('sumber_dana')
            ->pluck('jumlah', 'sumber_dana');

        return view('pages.dashboard', compact(
            'totalProyek',
            'totalUser',
            'totalWarga',
            'proyekAktif',
            'proyekPerTahun',
            'sumberDana'
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
