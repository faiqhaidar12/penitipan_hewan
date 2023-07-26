<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Pelanggan;
use App\Models\Penitipan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class HewanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $data = Hewan::where(function ($query) use ($keyword) {
            $query->where('nama_hewan', 'LIKE', '%' . $keyword . '%')
                ->orWhere('jenis_hewan', 'LIKE', '%' . $keyword . '%')
                ->orWhere('umur', 'LIKE', '%' . $keyword . '%')
                ->orWhere('berat', 'LIKE', '%' . $keyword . '%')
                ->orWhereHas('pelanggan', function ($query) use ($keyword) {
                    $query->where('nama_pelanggan', 'LIKE', '%' . $keyword . '%');
                });
        })
            ->with('pelanggan') // Menyertakan relasi dengan model Pelanggan
            ->latest()
            ->orderBy('nama_hewan', 'asc')
            ->paginate(5);
        return view('hewan.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggan_id = Pelanggan::all();
        $data = Hewan::all();
        return view('hewan.create')->with('pelanggan', $pelanggan_id)->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nama_hewan', $request->nama_hewan);
        Session::flash('jenis_hewan', $request->jenis_hewan);
        Session::flash('umur', $request->umur);
        Session::flash('berat', $request->berat);
        Session::flash('pelanggan_id', $request->pelanggan_id);

        $request->validate([
            'nama_hewan' => 'required',
            'jenis_hewan' => 'required',
            'umur' => 'required|numeric',
            'berat' => 'required|numeric',
            'pelanggan_id' => 'required|exists:pelanggan,id'
        ], [
            'nama_hewan.required' => 'Nama Hewan Harus diisi!!',
            'jenis_hewan.required' => 'Jenis Hewan Harus diisi!!',
            'umur.required' => 'Umur Harus diisi!!',
            'umur.numeric' => 'Umur Harus diisi Dengan Angka!!',
            'berat.required' => 'Berat Harus diisi!!',
            'berat.numeric' => 'Berat Harus diisi Dengan Angka!!',
            'pelanggan_id.required' => 'Pemilik Harus dipilih!!',
            'pelanggan_id.exists' => 'Pemilik Harus dipilih!!',
        ]);

        $data = [
            'nama_hewan' => $request->input('nama_hewan'),
            'jenis_hewan' => $request->input('jenis_hewan'),
            'umur' => $request->input('umur'),
            'berat' => $request->input('berat'),
            'pelanggan_id' => $request->input('pelanggan_id')
        ];

        Hewan::create($data);

        return redirect('hewan')->with('success', "Data Berhasil ditambahkan!!");
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
        $pelanggan_id = Pelanggan::all();
        $data = Hewan::where('id', $id)->first();
        return view('hewan.edit')->with('data', $data)->with('pelanggan', $pelanggan_id);
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
            'nama_hewan' => 'required',
            'jenis_hewan' => 'required',
            'umur' => 'required|numeric',
            'berat' => 'required|numeric',
            'pelanggan_id' => 'required|exists:pelanggan,id'
        ], [
            'nama_hewan.required' => 'Nama Hewan Harus diisi!!',
            'jenis_hewan.required' => 'Jenis Hewan Harus diisi!!',
            'umur.required' => 'Umur Harus diisi!!',
            'umur.numeric' => 'Umur Harus diisi Dengan Angka!!',
            'berat.required' => 'Berat Harus diisi!!',
            'berat.numeric' => 'Berat Harus diisi Dengan Angka!!',
            'pelanggan_id.required' => 'Pemilik Harus dipilih!!',
            'pelanggan_id.exists' => 'Pemilik Harus dipilih!!',
        ]);

        $data = [
            'nama_hewan' => $request->input('nama_hewan'),
            'jenis_hewan' => $request->input('jenis_hewan'),
            'umur' => $request->input('umur'),
            'berat' => $request->input('berat'),
            'pelanggan_id' => $request->input('pelanggan_id')
        ];

        Hewan::where('id', $id)->update($data);
        return redirect('/hewan')->with('update', "Berhasil Update Data!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $penitipan = Penitipan::where('hewan_id', $id)->first();
        if ($penitipan) {
            //jika ada data hewan yang sedang dititipkan, maka hentikan proses delete
            throw ValidationException::withMessages(['hewan_id' => 'Data Hewan Sedang dititipkan di penitipan']);
        }
        Hewan::where('id', $id)->delete();
        return redirect('/hewan')->with('success', 'Berhasil Hapus Data!!');
    }
}
