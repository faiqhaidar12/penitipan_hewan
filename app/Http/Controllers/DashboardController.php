<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Pelanggan;
use App\Models\Penitipan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalHewan = Hewan::count();
        $totalDititipkan = Penitipan::where('status', 'dititipkan')->count();
        $totalDiambil = Penitipan::where('status', 'diambil')->count();
        $totalDibatalkan = Penitipan::where('status', 'dibatalkan')->count();
        $totalPendapatan = Penitipan::where('status', 'diambil')->sum('biaya');

        return view('dashboard.index', compact(
            'totalPelanggan',
            'totalHewan',
            'totalDititipkan',
            'totalDiambil',
            'totalDibatalkan',
            'totalPendapatan'
        ));
    }
}
