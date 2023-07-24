<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HewanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Hewan::latest()->orderBy('nama_hewan', 'asc')->paginate(6);
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
        return view('hewan.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
