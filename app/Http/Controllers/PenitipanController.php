<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Penitipan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenitipanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Penitipan::latest()->orderBy('id', 'asc')->paginate(10);
        return view('penitipan.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $hewan_id = Hewan::all();
        $hewan_id = Hewan::availableForPenitipan();
        $data = Penitipan::all();
        return view('penitipan.create')->with('hewan', $hewan_id)->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_masuk' => 'required|date',
            'tgl_keluar' => 'required|date|after_or_equal:tanggal_masuk',
            'hewan_id' => 'required|exists:hewan,id',
            'status' => 'required'
        ], [
            'tgl_masuk.required' => 'Tanggal Masuk Harus dipilih!',
            'tgl_masuk.date' => 'Anda Bukan Memasukan Tanggal!',
            'tgl_keluar.required' => 'Tanggal Keluar Harus dipilih!',
            'tgl_keluar.date' => 'Anda Bukan Memasukan Tanggal!',
            'hewan_id.required' => 'Hewan Harus dipilih!!',
            'hewan_id.exists' => 'Hewan Harus dipilih!!',
            'status.required' => 'Status Harus dipilih!!'
        ]);

        $tanggalMasuk = Carbon::parse($request->input('tgl_masuk'));
        $tanggalKeluar = Carbon::parse($request->input('tgl_keluar'));
        $biayaPerHari = 50000;

        //Hitung Selisih hari antara tanggal masuk dan keluar
        $selisihHari = $tanggalKeluar->diffInDays($tanggalMasuk) + 1; // Tambah 1 karena menghitung termasuk tanggal keluar

        //Hitung Biaya Total
        $biayaTotal = $selisihHari * $biayaPerHari;

        $data = [
            'tgl_masuk' => $tanggalMasuk,
            'tgl_keluar' => $tanggalKeluar,
            'biaya' => $biayaTotal,
            'hewan_id' => $request->input('hewan_id'),
            'status' => $request->input('status')
        ];

        Penitipan::create($data);

        return redirect('penitipan')->with('success', 'Data Berhasil ditambahkan!!')->with('biayaTotal', $biayaTotal);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $hewan_id = Hewan::all();
        $hewan_id = Hewan::availableForPenitipan();
        $data = Penitipan::where('id', $id)->first();
        return view('penitipan.edit')->with('data', $data)->with('hewan', $hewan_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_masuk' => 'required|date',
            'tgl_keluar' => 'required|date|after_or_equal:tanggal_masuk',
            'hewan_id' => [
                'required',
                'exists:hewan,id',
                function ($attribute, $value, $fail) use ($id) {
                    // Menggunakan closure untuk memeriksa bahwa hewan yang diupdate tidak sedang digunakan di data penitipan lainnya
                    $hewan = Hewan::availableForUpdate($id, $value)->first();
                    if (!$hewan || $hewan->id == $id) {
                        // Tambahkan pengecualian untuk hewan yang sedang diubah statusnya
                        return;
                    }
                    $fail('Hewan yang dipilih sudah digunakan dalam data penitipan lainnya.');
                },
            ],
            'status' => 'required'
        ], [
            'tgl_masuk.required' => 'Tanggal Masuk Harus dipilih!',
            'tgl_masuk.date' => 'Anda Bukan Memasukan Tanggal!',
            'tgl_keluar.required' => 'Tanggal Keluar Harus dipilih!',
            'tgl_keluar.date' => 'Anda Bukan Memasukan Tanggal!',
            'hewan_id.required' => 'Hewan Harus dipilih!!',
            'hewan_id.exists' => 'Hewan Harus dipilih!!',
            'status.required' => 'Status Harus dipilih!!'
        ]);

        $tanggalMasuk = Carbon::parse($request->input('tgl_masuk'));
        $tanggalKeluar = Carbon::parse($request->input('tgl_keluar'));
        $biayaPerHari = 50000;

        //Hitung Selisih hari antara tanggal masuk dan keluar
        $selisihHari = $tanggalKeluar->diffInDays($tanggalMasuk) + 1; // Tambah 1 karena menghitung termasuk tanggal keluar

        //Hitung Biaya Total
        $biayaTotal = $selisihHari * $biayaPerHari;

        $data = [
            'tgl_masuk' => $tanggalMasuk,
            'tgl_keluar' => $tanggalKeluar,
            'biaya' => $biayaTotal,
            'hewan_id' => $request->input('hewan_id'),
            'status' => $request->input('status'),
        ];

        Penitipan::where('id', $id)->update($data);

        return redirect('penitipan')->with('success', 'Berhasil Update Data!!')->with('biayaTotal', $biayaTotal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Penitipan::where('id', $id)->delete();
        return redirect('/penitipan')->with('success', 'Berhasil Hapus Data!!');
    }
}
