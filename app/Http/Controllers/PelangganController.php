<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function Ramsey\Uuid\v1;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Pelanggan::all();
        $data = Pelanggan::latest()->orderBy('nama_pelanggan', 'asc')->paginate(6);
        return view('pelanggan.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nama_pelanggan', $request->nama_pelanggan);
        Session::flash('alamat', $request->alamat);
        Session::flash('email', $request->email);
        Session::flash('telepon', $request->telepon);

        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'email' => 'required|unique:pelanggan,email',
            'telepon' => 'required|numeric',
        ], [
            'nama_pelanggan.required' => "Nama Pelanggan Wajib diisi!!",
            'alamat.required' => "Alamat Pelanggan Wajib diisi!!",
            'email.required' => "E-Mail Pelanggan Wajib diisi!!",
            'email.unique' => "E-Mail Pelanggan Sudah Dipakai!!",
            'telepon.required' => "Telepon Pelanggan Wajib diisi!!",
            'telepon.numeric' => "Telepon Wajib diisi Dengan Angka!!",
        ]);

        $data = [
            'nama_pelanggan' => $request->input('nama_pelanggan'),
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'telepon' => $request->input('telepon'),
        ];

        Pelanggan::create($data);

        return redirect('pelanggan')->with('success', "Data Berhasil ditambahkan!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pelanggan::where('nama_pelanggan', $id)->get();
        return view('pelanggan.show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
