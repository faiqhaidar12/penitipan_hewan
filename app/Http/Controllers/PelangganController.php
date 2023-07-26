<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use App\Models\Pelanggan;
use App\Models\Penitipan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = Pelanggan::all();
        $keyword = $request->input('keyword');

        $data = Pelanggan::where('nama_pelanggan', 'LIKE', '%' . $keyword . '%')
            ->orWhere('alamat', 'LIKE', '%' . $keyword . '%')
            ->orWhere('telepon', 'LIKE', '%' . $keyword . '%')
            ->latest()
            ->orderBy('nama_pelanggan', 'asc')
            ->paginate(6);
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
            'email' => 'required|email|unique:pelanggan,email',
            'telepon' => 'required|numeric',
            'foto' => 'required|mimes:png,jpg,jpeg|max:10240',
        ], [
            'nama_pelanggan.required' => "Nama Pelanggan Wajib diisi!!",
            'alamat.required' => "Alamat Pelanggan Wajib diisi!!",
            'email.required' => "E-Mail Pelanggan Wajib diisi!!",
            'email.unique' => "E-Mail Pelanggan Sudah Dipakai!!",
            'telepon.required' => "Telepon Pelanggan Wajib diisi!!",
            'telepon.numeric' => "Telepon Wajib diisi Dengan Angka!!",
            'foto.mimes' => "Jenis Foto Yang Anda Masukan Bukan Png,Jpg,Jpeg!!",
            'foto.required' => "Foto Wajib diinput!!",
            'foto.max' => "Ukuran File Yang Anda Masukan Terlalu Besar!!",
        ]);

        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
        $foto_file->move(public_path('foto'), $foto_nama);


        $data = [
            'nama_pelanggan' => $request->input('nama_pelanggan'),
            'alamat' => $request->input('alamat'),
            'email' => $request->input('email'),
            'telepon' => $request->input('telepon'),
            'foto' => $foto_nama,
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
        $data = Pelanggan::where('id', $id)->get();
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
        $data = Pelanggan::where('id', $id)->first();
        return view('pelanggan.edit')->with('data', $data);
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
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:pelanggan,email,' . $id, ',id',
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

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'mimes:png,jpg,jpeg|max:10240',
            ], [
                'foto.mimes' => "Jenis Foto Yang Anda Masukan Bukan Png,Jpg,Jpeg!!",
            ]);

            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('foto'), $foto_nama);
            //sudah tersimpan di direktori

            $data_foto = Pelanggan::where('id', $id)->first();
            File::delete(public_path('foto') . '/' . $data_foto->foto);

            $data['foto'] = $foto_nama;
        }


        Pelanggan::where('id', $id)->update($data);
        return redirect('/pelanggan')->with('update', 'Berhasil Update Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataHewan = Hewan::where('pelanggan_id', $id)->exists();
        if ($dataHewan) {
            // Jika ada data hewan yang masih terkait dengan pelanggan, tampilkan pesan kesalahan
            throw ValidationException::withMessages(['Pelanggan Tidak Dapat dihapus Karena Masih Memiliki Data Hewan Yang Terkait!!']);
        }
        $data = Pelanggan::where('id', $id)->first();
        File::delete(public_path('foto') . '/' . $data->foto);

        Pelanggan::where('id', $id)->delete();
        return redirect('/pelanggan')->with('success', 'Berhasil Hapus Data!');
    }
}
